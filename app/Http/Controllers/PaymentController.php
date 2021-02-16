<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckoutRequest;
use App\Models\PaymentSession;
use App\Models\Subscription;
use App\Models\User;
use App\Modules\StripeTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Balance;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    use StripeTrait;

    public function __construct()
    {
        $this->stripe_init();
    }

    /**
     * Get stripe account balance
     * @return JsonResponse|Balance
     */
    public function getBalance()
    {
        try {
            return $this->stripe->balance->retrieve();
        } catch (ApiErrorException $e) {
            Log::error($e);
            return respond('Error getting balance');
        }
    }

    public function checkout(CreateCheckoutRequest $request)
    {
        $product = Subscription::where('name', $request->input('subscription'))
            ->first()->stripe_price_id;
        $session = $this->createSession($product);

        $payment_session = new PaymentSession();
        $payment_session->user_id = auth()->user()->id;
        $payment_session->session_id = $session->id;
        $payment_session->subscription = $request->input('subscription');
        $payment_session->status = 'pending';
        $payment_session->save();

        return $session;
    }

    public function stripeToken()
    {
        return settings('stripe_publishable_key');
    }

    public function statusUpdate(Request $request)
    {
        Log::info(json_encode($request->all()));
//        die;
        try {
            $status = $request->all();

            if ($status['type'] === 'checkout.session.completed') {
                $session_id = $status['data']['object']['id'];
                $payment_session = PaymentSession::where('session_id', $session_id)->first();
                $payment_session->status = 'completed';

                $user = User::find($payment_session->user_id);
                $user->subscription = Subscription::where('name', $payment_session->subscription)->first()->id;
                $user->subscription_id = $status['data']['object']['subscription'];

                $user->save();

                $payment_session->save();

                return respond('success');
            } else if ($status['type'] === 'checkout.session.async_payment_failed') {
                $session_id = $status['data']['object']['id'];
                $payment_session = PaymentSession::where('session_id', $session_id)->first()->delete();

                return respond('success');
            }

        }catch (\Exception $exception){
            Log::error($exception);
            respond('failed', 500);
        }

    }

    public function cancelSubscription()
    {
        $user = User::find(auth()->id());

        $user->subscription = 1;
        $user->save();

        $this->cancel($user->subscription_id);

        return respond('Successfully cancelled');
    }
}
