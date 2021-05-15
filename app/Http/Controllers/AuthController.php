<?php

namespace App\Http\Controllers;

use App\Http\Requests\IsEmailExistRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Weight;
use App\Modules\StripeTrait;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use StripeTrait;

    public function __construct()
    {

        $this->middleware('auth')
            ->only(['logout']);

        // stripe initialize
        $this->stripe_init();
    }

    // login to a session
    public function login(LoginRequest $request)
    {
        if(!$token = auth()->attempt($request->validated())){
            return respond('Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    // logout from session
    public function logout()
    {
        auth()->logout();
        return respond('Successfully logged out');
    }

    // update profile
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->zip_code = $request->input('zip_code');
        $user->gender = $request->input('gender');
        $user->height = $request->input('height');
        $user->weight = $request->input('weight');
        $user->age = $request->input('age');
        $user->save();

        // update weight in workout also
        $user->updateUserWeight($user->weight);

        return new UserResource($user);
    }


    /**
     * Register a user
     * @param SignupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(SignupRequest $request)
    {

        // set data form request to $form variable
        $form = $request->validated();


        // add role = user
        $form['role'] = 'user';
        // add subscription to free
        $form['subscription'] = Subscription::where('name', 'Free')->first()->id;

        try {

            // try to create a stripe customer
            $respond = $this->createCustomer([
                'email' => $form['email'],
                'name' => $form['name'],
                'metadata' => [
                    'Subscription' => 'Free'
                ]
            ]);

            // if couldn't create
            if(!$respond) return respond('Error in creating stripe customer', 500);

            // set stripe id
            $form['stripe_id'] = $respond->id;

            // create user using $form
            $user = User::create($form);

            // create a weight field for the created user
            Weight::create([
                'user_id' => $user->id,
                'goal_weight' => $user->weight - 20,
                'data' => json_encode([['weight' => $user->weight, 'date' => new Date()]])
            ]);

            // set $token
            if(!$token = auth()->login($user)){
                return respond('Unauthorized', 401);
            }
            return $this->respondWithToken($token);
        }catch(\Exception $e){
            Log::error($e);
            dd($e);
            return respond('Error in registration', 422);
        }
    }

    // return user
    public function getUser(): UserResource
    {
        return new UserResource(auth()->user());
    }


    // check if the email exist
    public function isEmailExist(IsEmailExistRequest $request): string
    {
        if(User::where('email', $request->input('email'))->exists()){
            return 'TRUE';
        }else{
            return 'FALSE';
        }
    }

    // token response
    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600 * 60,
            'user' => new UserResource(auth()->user())
        ]);
    }
}
