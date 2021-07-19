<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            AdminAuthMiddleware::class
        ])->only('create', 'update', 'delete');
    }

    public function index()
    {
        return BlogResource::collection(Blog::orderBy('created_at', 'DESC')->get());
    }

    public function create(BlogCreateRequest $request)
    {
        $request->merge(['author' => auth()->id()]);
        try {
            $blog = Blog::create($request->all());
            return respondWithObject('Successfully updated', $blog, 200);
        }catch(\Exception $exception){
            dd($exception);
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return respond('Successfully deleted', 200);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function update(Blog $blog, BlogUpdateRequest $request)
    {
        try {
            $blog->update($request->validated());
            return respondWithObject('Successfully updated', $blog);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function getRecent3Blogs(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return BlogResource::collection(Blog::orderBy('id', 'desc')->take(3)->get());
    }

    public function getBlogCategories()
    {
        return Blog::select('category')->groupBy('category')->get();
    }

    public function getBlogsByCategory(string $category): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return BlogResource::collection(Blog::where('category', '=',$category)->get());
    }
}
