<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use http\Env\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
        return PageResource::collection(Page::all());
    }

    public function create(CreatePageRequest $request)
    {
        $request->merge(['author' => auth()->id()]);
        try {
            $page = Page::create($request->all());
            return respondWithObject('Successfully updated', $page, 200);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function show(Page $page)
    {
        return new PageResource($page);
    }

    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return respond('Successfully deleted', 200);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }

    public function update(Page $page, PageUpdateRequest $request)
    {
        try {
            $page->update($request->validated());
            return respondWithObject('Successfully updated', $page);
        }catch(\Exception $exception){
            Log::error($exception);
            return respond('Server Error', 500);
        }
    }
}
