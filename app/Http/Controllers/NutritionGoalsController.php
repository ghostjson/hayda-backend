<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Requests\NutritionCreateRequest;
use App\Http\Requests\NutritionUpdateRequest;
use App\Http\Resources\NutritionGoalsResource;
use App\Models\Blog;
use App\Models\NutritionGoal;
use Illuminate\Support\Facades\Log;

class NutritionGoalsController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdminAuthMiddleware::class)->only([
            'create', 'destroy', 'update'
        ]);
    }

    public function index()
    {
        return NutritionGoalsResource::collection(NutritionGoal::all());
    }

    public function create(NutritionCreateRequest $request)
    {
        $request->merge(['author' => auth()->id()]);
        try {
            $blog = NutritionGoal::create($request->all());
            return respondWithObject('Successfully updated', $blog, 200);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function show(NutritionGoal $blog)
    {
        return new NutritionGoalsResource($blog);
    }

    public function destroy(NutritionGoal $blog)
    {
        try {
            $blog->delete();
            return respond('Successfully deleted', 200);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function update(NutritionUpdateRequest $request, NutritionGoal $blog)
    {
        try {
            $blog->update($request->validated());
            return respondWithObject('Successfully updated', $blog);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }
}
