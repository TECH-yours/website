<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\ChatLog;
use App\Models\User;
use App\Models\Restaurant;

use App\Http\Controllers\RestaurantController;

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

function registerUser($bot, $userId)
{
    $response = $bot->getProfile($userId);
    if ($response->isSucceeded())
        $tmp = User::store($response->getJSONDecodedBody());
    else
        Log::error($response->getHTTPStatus() . ' ' . $response->getRawBody());
}

function handleTextMessage($bot, $reply_token, $userId, $text) 
{
    $pattern = '/^(.+)@(.+)$/';
    
    if (preg_match($pattern, $text, $matches)) {
        $restaurantName = $matches[1];
        $mealName = $matches[2];
        $bot->replyText($reply_token, "Restaurant: $restaurantName, Meal: $mealName");
    } else {
        func_chatgpt($userId, $text, $bot, $reply_token);
    }
}

function func_chatgpt($userId, $text, $bot, $reply_token)
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

function handleLocationMessage($bot, $reply_token, $userId, $latitude, $longitude)
{
    $request = new Request();
    $request->merge([ 'lat' => $latitude, 'lng' => $longitude]);
    $RestaurantController = new RestaurantController();
    $restaurant = $RestaurantController->getRestaurant($request);    

    $columns = generateCard_resataurant($restaurant);
    sendCard($userId, $columns);
}

function generateCard_resataurant($restaurant)
{
    $columns = [];
    foreach($restaurant as $r)
    {
        $MealsController = new MealsController();
        $meals = $MealsController->getMealsByRestaurantId($r->id);
        $actions = [];
        if (count($meals) == 0) continue;
        foreach($meals as $m)
        {
            array_push($actions, [
                "type" => "message",
                "label" => $m->name,
                "text" => "[" . $r->name . "]@" . $m->name
            ]);
            if (count($actions) >= 3) break ;
        }
        $host = "https://ec2-16-170-110-7.eu-north-1.compute.amazonaws.com/images/restaurant/";
        array_push($columns, [
            "thumbnailImageUrl" => ($host . $r->thumbnailImageUrl),
            "imageBackgroundColor" => "#FFFFFF",
            "title" => $r->name,
            "text" => $r->address,
            "defaultAction" => [
                "type" => "uri",
                "label" => "打開地圖",
                "uri" => $r->google_map_url
            ],
            "actions" => $actions
        ]);
        if (count($columns) >= 3) break ;
    }
    return $columns;
}

function sendCard($userId, $columns)
{
    try {
        $client = \Illuminate\Support\Facades\Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN')
        ])->timeout(300);

        $response = $client->post('https://api.line.me/v2/bot/message/push', 
        [
            "to" => $userId,
            "messages" => [
                [
                    "type" => "template",
                    "altText" => "餐廳推薦",
                    "template" => [
                        "type" => "carousel",
                        "columns" => $columns,
                        "imageAspectRatio" => "rectangle",
                        "imageSize" => "cover"
                    ]
                ]
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
