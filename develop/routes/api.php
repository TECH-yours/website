<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use LINE\LINEBot\Constant\HTTPHeader;
// class LineMessageController extends Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/callback', function(Request $request){

    $ChannelAccessToken = env('LINE_CHANNEL_ACCESS_TOKEN'); //'QhIrTjbp4Y2TxAWVLYNZmFETOPC/R6r7utvGKBcMqWCZZok+sB/E/plPr/nobz6ww2AsRYrXGc3NRGeSO3sqEeYh45HCXUW7OzD8IRkgMXywUQZWJJE4qtz1UJSqxJpJFfNkZhA0qYQbrVXTq3NrugdB04t89/1O/w1cDnyilFU=';
    $ChannelUserId = env('LINE_CHANNEL_USERID'); //'1660879908';
    $ChannelSecret = env('LINE_CHANNEL_SECRET'); //'06781fc855c82ce0cb9c8552e09a742c';

    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($ChannelAccessToken);
    $bot = new \LINE\LINEBot($httpClient,['channelSecret' => $ChannelSecret]);
    $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
    $body = $request->getContent();
    $events = $bot->parseEventRequest($body, $signature);
    foreach ($events as $event)
    {
        if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)
        {
            $reply_token = $event->getReplyToken();
            $text = $event->getText();

            $client = \Illuminate\Support\Facades\Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => env('CHATGPT_TOKEN')
            ]);
        
            $response = $client->post('https://api.openai.com/v1/chat/completions', 
            [
                'model' => "gpt-3.5-turbo-0301",
                "messages" => 
                [
                    [ "role" => "user", "content" => $text ]
                ]
            ]);
            
            $response_json = json_decode($response, true);
            Log::info($response_json);
            $chatgpt = $response_json['choices'][0]['message']['content'];
            
            $bot->replyText($reply_token, $chatgpt);
        }
    }
});

Route::get('/test', function(){
    $client = \Illuminate\Support\Facades\Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => env('CHATGPT_TOKEN')
    ]);

    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'model' => "gpt-3.5-turbo-0301",
        "messages" => [
            [
                "role" => "user", 
                "content" => "how many water should a person drinks everyday"
            ]
        ]
    ]);
    
    $response_json = json_decode($response, true);
    $chatgpt = $response_json['choices'][0]['message']['content'];

    return $chatgpt;
});