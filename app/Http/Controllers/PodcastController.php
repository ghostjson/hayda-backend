<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPodcastRequest;
use App\Http\Resources\PodcastResource;
use App\Models\Podcast;
use Illuminate\Support\Facades\Log;

class PodcastController extends Controller
{
    public function index()
    {
        return PodcastResource::collection(Podcast::all());
    }

    public function addLink(AddPodcastRequest $request)
    {
        try {
            $podcast = Podcast::create($request->validated());
            return respond('successfully created');
        }catch (\Exception $exception){
            Log::error($exception);
            return respond('error while creating', 500);
        }
    }

    public function removeLink(Podcast $podcast)
    {
        try {
            $podcast->delete();
            return respond('successfully deleted');
        }
        catch (\Exception $exception){
            Log::error($exception);
            return respond('Error in deletion', 500);
        }
    }
}
