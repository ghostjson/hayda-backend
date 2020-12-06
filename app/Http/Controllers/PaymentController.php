<?php

namespace App\Http\Controllers;

use App\Modules\StripeTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Stripe\Balance;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    use StripeTrait;



    /**
     * Get stripe account balance
     * @return JsonResponse|Balance
     */
    public function getBalance()
    {
        try {
            return $this->stripe->balance->retrieve();
        } catch (ApiErrorException $e) {
            dd($e);
            Log::error($e);
            return respond('Error getting balance');
        }
    }


}
