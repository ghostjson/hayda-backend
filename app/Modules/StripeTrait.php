<?php

namespace App\Modules;

use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

trait StripeTrait{

    public $stripe;

    public function stripe_init()
    {
        $this->stripe = new StripeClient(settings('stripe_secret_key'));
    }

    public function createCustomer($customer)
    {

        try {
            return $this->stripe->customers->create($customer);
        } catch (ApiErrorException $e) {
            Log::error($e);
            return false;
        }
    }

    public function createProduct($name)
    {
        return $this->stripe->products->create([
            'name' => $name
        ]);
    }

    public function listProducts()
    {
        return $this->stripe->products->all();
    }

    public function deactivateProducts()
    {
        foreach ($this->listProducts() as $product){
            $this->stripe->products->update($product->id, [
                'active' => false
            ]);
        }

    }

    public function createPrice($product_id, $price)
    {

        return $this->stripe->prices->create([
            'unit_amount' => $price * 100,
            'currency' => 'usd',
            'recurring' => ['interval' => 'year'],
            'product' => $product_id
        ]);

    }


    public function updatePrice($price_id,$product_id, $price)
    {
        $this->stripe->prices->update($price_id, [
            'active' => false
        ]);

        return $this->stripe->prices->create([
            'unit_amount' => $price * 100,
            'currency' => 'usd',
            'recurring' => ['interval' => 'year'],
            'product' => $product_id
        ])->id;
    }

    public function createSession($product)
    {
        return $this->stripe->checkout->sessions->create([
            'success_url' => settings('web_app_url') . '/success',
            'cancel_url' => settings('web_app_url') . '/cancel',
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => $product,
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
        ]);
    }

    public function cancel(string $subscription_id)
    {
        $this->stripe->subscriptions->cancel(
            $subscription_id, []
        );
    }

}
