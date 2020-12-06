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

}
