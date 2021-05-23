<?php

namespace App\Http\Controllers;

use App\Http\Requests\HealthHubLinkCreateRequest;
use App\Http\Requests\HealthHubLinkUpdateRequest;
use App\Http\Resources\HealthHubLinkResource;
use App\Models\HealthHub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class HealthHubController extends Controller
{

    /**
     * Link all links group by categories
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        return HealthHubLinkResource::collection(
            HealthHub::all()
                ->sortBy('category')
//                ->sortBy('link_priority')
                ->groupBy('category')
        );
    }

    /**
     * Create a link
     * @param HealthHubLinkCreateRequest $request
     * @return JsonResponse
     */
    public function create(HealthHubLinkCreateRequest $request): JsonResponse
    {
        try {
            $health_hub_link = HealthHub::create($request->validated());
            return respondWithObject('Successfully created', $health_hub_link);
        } catch (\Exception $e) {
            Log::error($e);
            return respond('Server Error', 200);
        }
    }

    /**
     * Get a given link by ID
     * @param HealthHub $healthHub
     * @return HealthHubLinkResource
     */
    public function show(HealthHub $healthHub): HealthHubLinkResource
    {
        return new HealthHubLinkResource($healthHub);
    }

    /**
     * Update a link
     * @param HealthHub $healthHub
     * @param HealthHubLinkUpdateRequest $request
     * @return JsonResponse
     */
    public function update(HealthHub $healthHub, HealthHubLinkUpdateRequest $request): JsonResponse
    {
        try {
            $healthHub->update($request->validated());
            return respondWithObject('Successfully updated', $healthHub);
        } catch (\Exception $exception) {
            Log::error($exception);
            return respond('Server Error', 200);
        }
    }

    /**
     * Delete a link
     * @param HealthHub $healthHub
     * @return JsonResponse
     */
    public function destroy(HealthHub $healthHub): JsonResponse
    {
        try {
            $healthHub->delete();
            return respond('Successfully deleted');
        } catch (\Exception $exception) {
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }


    /**
     * Increase priority of the given category
     * @param $category
     * @return JsonResponse
     */
    public function increaseCategoryPriority($category): JsonResponse
    {
        // get a sample link from $category
        $sampleLink = HealthHub::where('category', '=', $category)->first();

        // check if the category already in the highest priority
        if ($sampleLink->category_priority != "0") {

            // go back if there is any gap between priorities
            $seek = 1;
            while (!HealthHub::where('category_priority', '=', $sampleLink->category_priority - $seek)->exists()) {
                $seek++;
            }

            // swap priorities
            HealthHub::where('category_priority', '=', $sampleLink->category_priority - $seek)->update([
                'category_priority' => $sampleLink->category_priority - $seek + 1
            ]);

            HealthHub::where('category', '=', $category)->update(['category_priority' => $sampleLink->category_priority - $seek]);

            return respond('successfully increased priority of ' . $category);
        } else {
            return respond($category . ' already in highest priority.');
        }
    }


    /**
     * Decrease priority of the given category
     * @param $category
     * @return JsonResponse
     */
    public function decreaseCategoryPriority($category): JsonResponse
    {
        // get a sample link from $category
        $sampleLink = HealthHub::where('category', '=', $category)->first();

        // get total no of categories
        $no_of_categories = count(HealthHub::select('category')->distinct('category')->get()) - 1;

        // check if the category already has the highest priority
        if ($sampleLink->category_priority != $no_of_categories) {

            // go forward if there is any gap between priorities
            $seek = 1;
            while (!HealthHub::where('category_priority', '=', $sampleLink->category_priority + $seek)->exists()) {
                $seek++;
            }


            // swap priorities
            HealthHub::where('category_priority', '=', $sampleLink->category_priority + $seek)->update([
                'category_priority' => $sampleLink->category_priority
            ]);

            HealthHub::where('category', '=', $category)->update(['category_priority' => $sampleLink->category_priority + $seek]);

            return respond('successfully decreased priority of ' . $category);
        } else {
            return respond($category . ' already in least priority.');
        }
    }

    /**
     * Increase priority of the given link
     * @param HealthHub $healthHub
     * @return JsonResponse
     */
    public function increaseLinkPriority(HealthHub $healthHub): JsonResponse
    {
        // check if the priority is already highest
        if ($healthHub->link_priority == '0') {
            return respond($healthHub->caption . ' has the highest priority.');
        } else {


            // swap
            HealthHub::where('category', '=', $healthHub->category)
                ->where('link_priority', '=', $healthHub->link_priority - 1)
                ->update(['link_priority' => $healthHub->link_priority]);

            $healthHub->link_priority = $healthHub->link_priority - 1;
            $healthHub->save();

            return respond($healthHub->caption . ' is successfully increased priority');
        }
    }

    /**
     * Decrease Priority of the given link
     * @param HealthHub $healthHub
     * @return JsonResponse
     */
    public function decreaseLinkPriority(HealthHub $healthHub): JsonResponse
    {
        // get maximum priority
        $max_priority = count(HealthHub::where('category', '=', $healthHub->category)->get()) - 1;

        // check if the given link is already in the maximum priority
        if ($healthHub->link_priority != $max_priority) {


            // swap
            HealthHub::where('category', '=', $healthHub->category)
                ->where('link_priority', '=', $healthHub->link_priority + 1)
                ->update(['link_priority' => $healthHub->link_priority]);

            $healthHub->link_priority = $healthHub->link_priority + 1;
            $healthHub->save();

            return respond($healthHub->caption . ' successfully decreased priority');
        } else {
            return respond($healthHub->caption . ' already has the lowest priority');
        }
    }
}
