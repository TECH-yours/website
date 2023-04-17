<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Exception;

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

Route::post('/callback', function(Request $request){
    $lineAccessToken = '06781fc855c82ce0cb9c8552e09a742c';
    $lineChannelSecret = 'QhIrTjbp4Y2TxAWVLYNZmFETOPC/R6r7utvGKBcMqWCZZok+sB/E/plPr/nobz6ww2AsRYrXGc3NRGeSO3sqEeYh45HCXUW7OzD8IRkgMXywUQZWJJE4qtz1UJSqxJpJFfNkZhA0qYQbrVXTq3NrugdB04t89/1O/w1cDnyilFU=';

    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($lineAccessToken);
    $bot = new \LINE\LINEBot($httpClient,['channelSecret' => $lineChannelSecret]);
    $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
    $body = $request->getContent();
    $events = $bot->parseEventRequest($body, $signature);
    foreach ($events as $event)
    {
        if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)
        {
            $reply_token = $event->getReplyToken();
            $text = $event->getText();
            $bot->replyText($reply_token, $text);
        }
    }
})->name('line.webhook');