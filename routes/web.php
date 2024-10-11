<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\ChatboxController;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\ChatController;
Route::get('/', function () {
    return view('welcome');
});

Route::post('send',[ChatController::class, 'sendChat']);

Route::get('/test-openai',function(){
    try {
        $result = OpenAI::completions()->create([
            'model' => 'gpt-3.5-turbbo',
            'prompt' => "Generate a sentence about a beautiful sunset",
            'max_tokens' => 100,
        ]);
        return response()->json($result);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
