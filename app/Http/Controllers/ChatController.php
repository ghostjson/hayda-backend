<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Requests\ChatbotPutRequest;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdminAuthMiddleware::class)
            ->only(['getIntents', 'putIntents']);
    }

    /**
     * @param ChatRequest $request
     * @return array
     */
    public function run(ChatRequest $request): array
    {

        $message = $request->input('message');


        $response = Http::get('http://localhost:8081/'.$message);

        return [
            'message' => $response->body()
        ];
    }

    public function getIntents()
    {
        $content = file_get_contents(env('CHATBOT_DATA'));

        return response((array) json_decode($content));
    }

    public function putIntents(ChatbotPutRequest $request): \Illuminate\Http\JsonResponse
    {
        $content = $request->validated();

        try {
            file_put_contents(env('CHATBOT_DATA'), json_encode($content));

            return respond('Successfully Updated');
        }catch (\Exception $exception){
            Log::error($exception);
            return respond('Error during update', 500);
        }

    }


}
