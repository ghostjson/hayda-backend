<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function run(ChatRequest $request)
    {
        $message = $request->input('message');
        return [
            'message' => 'Hello there, what can I do for you?'
        ];
    }

}
