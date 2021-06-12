<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWorkoutRequest;
use App\Http\Requests\SetWorkoutGoalRequest;
use App\Http\Resources\WorkoutResource;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    private $workout;

    public function __construct()
    {
        $this->middleware('auth');

        if (!is_null(auth()->id())){
            $this->workout = Workout::where('user_id', auth()->id());
        }else{
            return respond("User is not exist", 401);
        }

        if(!$this->workout->exists()){
            $this->workout = Workout::create([
                'meta' => '',
                'dates' => '',
                'met_goal' => '[]',
                'user_id' => auth()->id()
            ]);
        }else{
            $this->workout = $this->workout->first();
        }

    }

    public function get()
    {
        return new WorkoutResource($this->workout);
    }

    public function add(AddWorkoutRequest $request)
    {
         $this->workout->update([
                'dates' => $request->input('dates'),
                'duration' => $request->input('duration'),
                'met_goal' => $request->input('met_goal')
            ]);

         return new WorkoutResource(Workout::where('user_id', auth()->id())->first());
    }

    public function reset()
    {
        $this->workout->meta = '';
        $this->workout->dates = '';

        $this->workout->save();

        return new WorkoutResource($this->workout);
    }

    public function setGoal(SetWorkoutGoalRequest $request)
    {
        $this->workout->update([
            'meta' => $request->input('goal')
        ]);

        return new WorkoutResource($this->workout);
    }
}
