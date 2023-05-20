<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatLog extends Model
{
    use HasFactory;

    protected $table = 'log_chatgpt';

    public $timestamps = true;

    protected $guarded = [];

    public static function store($request)
    {
        $content = new ChatLog;
        $content->UserId = $request['UserId'];
        $content->userContent = $request['userContent'];
        $content->ChatgptId = $request['ChatgptId'];
        $content->gptContent = $request['gptContent'];
        $content->note = $request['note'];
        $content->save();
        return ($content->index);
    }

    public static function getChatLog($request)
    {
        $db = ChatLog::where('UserId', $request['UserId'])
                -> select ('userContent', 'gptContent', 'created_at')
                -> orderBy('created_at', 'asc')
                -> latest()
                -> take(5)
                -> get();
        
        foreach ($db as $key => $value) {
            array_push($request['History'], [
                'role' => 'user',
                'content' => $value->userContent
            ]);
            array_push($request['History'], [
                'role' => 'assistant',
                'content' => $value->gptContent
            ]);
        }
        return ($request['History']);
    }
}
