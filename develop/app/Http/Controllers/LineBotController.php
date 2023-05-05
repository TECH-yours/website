<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\ChatLog;
use App\Models\User;
use App\Models\Restaurant;

use LINE\LINEBot\Constant\HTTPHeader;

use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\TextComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

class LineBotController extends Controller
{
    public function callback(Request $request)
    {
        $ChannelAccessToken = env('LINE_CHANNEL_ACCESS_TOKEN');
        $ChannelUserId = env('LINE_CHANNEL_USERID');
        $ChannelSecret = env('LINE_CHANNEL_SECRET');

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($ChannelAccessToken);
        $bot = new \LINE\LINEBot($httpClient,['channelSecret' => $ChannelSecret]);
        $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
        $body = $request->getContent();
        $events = $bot->parseEventRequest($body, $signature);
        foreach ($events as $event)
        {
            $reply_token = $event->getReplyToken();
            $userId = $event->getUserId();

            // register user
            registerUser($bot, $userId);

            // Text message
            if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)
                handleTextMessage($bot, $reply_token, $userId, $event->getText());
            
            // location message
            if ($event instanceof \LINE\LINEBot\Event\MessageEvent\LocationMessage)
                handleLocationMessage($bot, $reply_token, $userId, $event->getLatitude(), $event->getLongitude());
        }
    }
}

function handleTextMessage($bot, $reply_token, $userId, $text) 
{
    $chatgpt = '';
    $chatgptID = '';
    $messageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('系統處理中，請稍後...');
    $response = $bot->pushMessage($userId, $messageBuilder);
    $history = [];
    array_push($history, [ 'role' => 'system', 'content' => '你現在是一名營養顧問，請使用繁體中文回答所有問題。' ]);
    $history = ChatLog::getChatLog([ 'History' => [],  'UserId' => $userId ]);
    array_push($history, [ 'role' => 'user', 'content' => $text ]);
    // send to chatgpt
    try {
        $client = \Illuminate\Support\Facades\Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => env('CHATGPT_TOKEN')
        ])->timeout(300);
    
        $response = $client->post('https://api.openai.com/v1/chat/completions', 
        [
            'model' => "gpt-3.5-turbo-0301",
            "messages" => $history,
        ]);
        
        $response_json = json_decode($response, true);
        Log::info($response);
        $chatgpt = $response_json['choices'][0]['message']['content'];
        $chatgptID = $response_json['id'];
        $bot->replyText($reply_token, $chatgpt);
    } catch (TransferException $e) {
        // Handle timeout error
        Log::error("Timeout error");
        $bot->replyText($reply_token, '系統發生錯誤，請稍後再試');
    } catch (\Throwable $th) {
        Log::error($th);
        $bot->replyText($reply_token, '系統發生錯誤，請稍後再試');
    } finally {
        ChatLog::store([
            'UserId' => $userId,
            'ChatgptId' => $chatgptID,
            'userContent' => $text,
            'gptContent' => $chatgpt,
            'note' => ($chatgptID) ? ''  : 'error',
        ]);
    }
}

function haversineDistance($origin, $destination)
{
    $lat1 = deg2rad($origin['lat']);
    $lon1 = deg2rad($origin['lng']);
    $lat2 = deg2rad($destination['lat']);
    $lon2 = deg2rad($destination['lng']);
    
    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;
    
    $a = sin($deltaLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    $distance = 6371 * $c; // Earth's radius is approximately 6371 kilometers
    
    return $distance;
}

function handleLocationMessage($bot, $reply_token, $userId, $latitude, $longitude)
{
    $coordinates = Restaurant::all();

    $origin = ['lat' => $latitude, 'lng' => $longitude];

    $sorted = $coordinates->sort(function ($a, $b) use ($origin) {
        $distanceA = haversineDistance($origin, $a);
        $distanceB = haversineDistance($origin, $b);
        return $distanceA <=> $distanceB; // Use spaceship operator to compare distances
    });

    $closest = $sorted->first();

    $message = "You are closest to " . $closest['name'] . " ($latitude, $longitude)";
    $messageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
    $response = $bot->replyMessage($reply_token, $messageBuilder);

    // sendCard($userId);
}

function sendCard($userId)
{
    log::info('sendCard');
    try {
        $client = \Illuminate\Support\Facades\Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN')
        ])->timeout(300);

        $imageCarousel = [
            "type" => "template",
            "altText" => "this is a image carousel template",
            "template" => [
                "type" => "image_carousel",
                "columns" => [
                    [
                        "imageUrl" => "https://example.com/bot/images/item1.jpg",
                        "action" => [
                            "type" => "postback",
                            "label" => "Buy",
                            "data" => "action=buy&itemid=111"
                        ]
                    ],
                    [
                        "imageUrl" => "https://example.com/bot/images/item2.jpg",
                        "action" => [
                            "type" => "message",
                            "label" => "Yes",
                            "text" => "yes"
                        ]
                    ],
                    [
                        "imageUrl" => "https://example.com/bot/images/item3.jpg",
                        "action" => [
                            "type" => "uri",
                            "label" => "View detail",
                            "uri" => "http://example.com/page/222"
                        ]
                    ]
                ]
            ]
        ];
        
    
        $response = $client->post('https://api.line.me/v2/bot/message/push', 
        [
            "to" => $userId,
            "messages" => [
                $imageCarousel
            ]
        ]);
        
    } catch (TransferException $e) {
        // Handle timeout error
        Log::error("Timeout error");
        // $bot->replyText($reply_token, '系統發生錯誤，請稍後再試');
    } catch (\Throwable $th) {
        Log::error($th);
        // $bot->replyText($reply_token, '系統發生錯誤，請稍後再試');
    } finally {
        Log::info($response);
    }


}

function registerUser($bot, $userId)
{
    $response = $bot->getProfile($userId);
    if ($response->isSucceeded())
        $tmp = User::store($response->getJSONDecodedBody());
    else
        Log::error($response->getHTTPStatus() . ' ' . $response->getRawBody());
}

