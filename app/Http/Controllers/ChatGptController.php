<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;
class ChatGptController extends Controller
{
    //
    public function showpage(){

        return view('chat.index');

        }


    public function ask(Request $request){
        $prompt = $request->input('prompt');
        $response = $this->askToChatGPT($prompt);
        return view('chat.response', ['response' => $response]);
        }
       

    private function askToChatGPT($prompt){
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY') .'',
                'Accept: application/json',
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
                "prompt" =>str_replace('"', '', $prompt) ,
                "max_tokens" => 100,
                "temperature" => 0.9,
                'top_p' => 1,
                'frequency_penalty' => 0.0,
                'presence_penalty' => 0.0

            ]);

        return $response->json()['choices'][0]['text'];
        }

}
