<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['logout']);
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
        $form['subscriptionController'] = 'Basic: free';

        try {
            User::create($form);
            if(!$token = auth()->attempt(['email' => $form['email'], 'password' => $form['password']])){
                return respond('Unauthorized', 401);
            }
            return $this->respondWithToken($token);
        }catch(\Exception $e){
            Log::error($e);
            return respond('Error in registration', 422);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600 * 60,
            'user' => auth()->user()
        ]);
    }
}
