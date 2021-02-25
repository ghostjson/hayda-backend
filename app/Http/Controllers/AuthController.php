<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\Subscription;
use App\Models\User;
use App\Modules\StripeTrait;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use StripeTrait;

    public function __construct()
    {

        $this->middleware('auth')
            ->only(['logout']);

        $this->stripe_init();
    }

    public function login(LoginRequest $request)
    {
        if(!$token = auth()->attempt($request->validated())){
            return respond('Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return respond('Successfully logged out');
    }

    public function register(SignupRequest $request)
    {

        $form = $request->validated();
        $form['role'] = 'user';
        $form['subscription'] = Subscription::where('name', 'Free')->first()->id;

        try {

            $respond = $this->createCustomer([
                'email' => $form['email'],
                'name' => $form['name'],
                'metadata' => [
                    'Subscription' => 'Free'
                ]
            ]);

            if(!$respond) return respond('Error in creating stripe customer');

            $form['stripe_id'] = $respond->id;

            $user = User::create($form);

            if(!$token = auth()->login($user)){
                return respond('Unauthorized', 401);
            }
            return $this->respondWithToken($token);
        }catch(\Exception $e){
            Log::error($e);
            return respond('Error in registration', 422);
        }
    }

    public function getUser()
    {
        return new UserResource(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600 * 60,
            'user' => new UserResource(auth()->user())
        ]);
    }
}
