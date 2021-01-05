<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWeightRequest;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'addWeight', 'clearWeight', 'getWeight'
        ]);
    }


    //weight

    public function getWeight()
    {
        return Weight::getWeight();
    }

    public function addWeight(AddWeightRequest $request)
    {
        $entry = [
            'weight' => $request->input('weight'),
            'date' => Carbon::now()->format('d M Y')
        ];

        Weight::add($entry);

        return $entry;
    }

    public function clearWeight()
    {
        Weight::clearWeight();

        return respond('Weight is cleared');
    }
}
