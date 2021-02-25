<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Blog;
use App\Models\HealthHub;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $query = $request->validated()['query'];

        $health_hub = HealthHub::where('caption', 'LIKE', '%'.$query.'%')->get(['caption', 'link']);
        $blog = Blog::where('title', 'LIKE', '%'.$query.'%')->get();

        return [
            'health_hub' => $health_hub,
            'blog' => $blog
        ];
    }
}
