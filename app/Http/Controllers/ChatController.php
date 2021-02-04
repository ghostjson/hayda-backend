<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function run(ChatRequest $request)
    {
        $message = $request->input('message');

        $response = Http::asForm()->post('http://127.0.0.1:5000/reply', [
            'message' => $message
        ]);


        return [
            'message' => $response->body()
        ];
    }

}
