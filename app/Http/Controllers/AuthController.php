<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!$token = auth()->attempt($request->validated())){
            return respond('Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    public function signup(SignupRequest $request)
    {
        // pass
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
