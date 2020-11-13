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
    public function index() : ResourceCollection
    {
        return HealthHubLinkResource::collection(HealthHub::all()->groupBy('category'));
    }

    public function create(HealthHubLinkCreateRequest $request) : JsonResponse
    {
        try{
            $health_hub_link = HealthHub::create($request->validated());
            return respondWithObject('Successfully created', $health_hub_link);
        }catch (\Exception $e)
        {
            Log::error($e);
            return respond('Server Error', 200);
        }
    }

    public function show(HealthHub $healthHub) : HealthHubLinkResource
    {
        return new HealthHubLinkResource($healthHub);
    }

    public function update(HealthHub $healthHub, HealthHubLinkUpdateRequest $request)
    {
        try {
            $healthHub->update($request->validated());
            return respondWithObject('Successfully updated', $healthHub);
        }catch(\Exception $exception)
        {
            Log::error($exception);
            return respond('Server Error', 200);
        }
    }

    public function destroy(HealthHub $healthHub)
    {
        try {
            $healthHub->delete();
            return respond('Successfully deleted');
        }catch(\Exception $exception)
        {
            Log::error($exception);
            return respond('Server Error', 200);
        }
    }

}
