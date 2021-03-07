<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
{
    public function index()
    {
        return GameResource::collection(Game::all());
    }

    public function addLink(AddGameRequest $request)
    {
        try {
            $game = Game::create($request->validated());
            return respond('successfully created');
        }catch (\Exception $exception){
            Log::error($exception);
            return respond('error while creating', 500);
        }
    }

    public function removeLink(Game $game)
    {
        try {
            $game->delete();
            return respond('successfully deleted');
        }
        catch (\Exception $exception){
            Log::error($exception);
            return respond('Error in deletion', 500);
        }
    }
}
