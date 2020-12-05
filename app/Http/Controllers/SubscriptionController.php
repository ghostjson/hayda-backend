<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        return SubscriptionResource::collection(Subscription::all());
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $subscriptions = $request->validated()['subscriptions'];


        foreach ($subscriptions as $subscription)
        {

            Subscription::updateOrCreate(
                ['name' => $subscription['name']],
                [
                    'price' => $subscription['price'],
                    'features' => json_encode($subscription['features']),
                ]
            );
        }

        return respond('Successfully updated');

    }


}
