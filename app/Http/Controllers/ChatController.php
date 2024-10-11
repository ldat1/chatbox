<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{
    public function senChat(Request $request)
    {
        $userMesage = $request->input('input');
        Log::info('User message: '. $userMesage);

        $responses = [
            'hello'=> 'HI ! How can i assist you today?',
            
            'how are you'=> 'i am good ',
            
            'bye'=> 'bye bye bye',
            
            'i am handsome right ?'=> 'yah sure',
            
            'default'=> 'Sorry',

        ];

        $response = $responses['default'];

        foreach ($responses as $key => $reply) {
            if (stripos($userMesage, $key) !== false) {
                $response = $reply;
                break;
            }
        }
        Log::info($response);
        return response()->json($response);
    }
}
