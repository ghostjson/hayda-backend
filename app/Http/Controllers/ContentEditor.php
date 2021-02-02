<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutPageContentRequest;
use App\Http\Resources\PageContentResource;
use App\Models\PageContent;
use Illuminate\Support\Facades\Log;

class ContentEditor extends Controller
{
    public function index()
    {
        return PageContentResource::collection(PageContent::all());
    }

    public function getPage(string $name)
    {
        return new PageContentResource(PageContent::where('name', $name)->first());
    }

    public function putPage(PutPageContentRequest $request, string $name)
    {
        try {
            PageContent::where('name', $name)
                ->update($request->validated());
            return respond('Successfully updated page content');
        } catch (\Exception $exception) {
            Log::error($exception);
            return respond('Error updating page content');
        }
    }
}
