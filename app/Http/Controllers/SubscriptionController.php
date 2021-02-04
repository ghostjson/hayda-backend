<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Modules\StripeTrait;

class SubscriptionController extends Controller
{
    use StripeTrait;

    public function __construct()
    {
        $this->stripe_init();
    }

    public function index()
    {
        return SubscriptionResource::collection(Subscription::all());
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $subscriptions = $request->validated()['subscriptions'];

        foreach ($subscriptions as $subscription)
        {
            $subModel = Subscription::where('name', $subscription['name'])->first();
            $subModel->price = $subscription['price'];
            $subModel->features = json_encode($subscription['features']);

            $subModel->stripe_price_id = $this->updatePrice($subModel->stripe_price_id, $subModel->stripe_id, $subscription['price']);

            $subModel->save();
        }

        return respond('Successfully updated');

    }

    public function subscribe()
    {

    }


}
