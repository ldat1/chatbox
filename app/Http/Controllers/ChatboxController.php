<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ChatboxController extends Controller
{
    public function senChat(Request $request)
    {
        $prompt = $request->input('input');

        try {
            $result = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbbo',
                'prompt' => "Generate a sentence about a beautiful sunset",
                'max_tokens' => 100,
            ]);

            $response = array_reduce(
                $result->toArray()['choise'],
                fn($carry, $choice) => $carry . $choice['text'],
            );

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['erroe' => 'An error occured please check log'], 500);
        }
    }
}
