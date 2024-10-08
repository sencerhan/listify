<?php

namespace App\Http\Service;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageService {

    /*
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->integer('sender_id');
        $table->integer('reciever_id');
        $table->longText('message');
        $table->boolean('is_reached')->default(false);
        $table->boolean('is_seen')->default(false);
        $table->string('file_path')->nullable();
        $table->boolean('is_deleted')->default(false);
        $table->timestamps();
    }); 
    */

    public static function send(int $receiver_id, string $messageContent) {
        $message = new Message();
        $message->receiver_id = $receiver_id;
        $message->message = $messageContent;
        $message->sender_id = Auth::user()->id;
        $message->save();
        //dd($message);
        return $message;
    }

    public static function getMessagesByUserId(int $user_id, $more = null) {
        $messages = Message::where('receiver_id', $user_id)->where('sender_id', Auth::user()->id)
        ->orWhere('receiver_id', Auth::user()->id)
                  ->where('sender_id', $user_id)
        ->orderBy('created_at', 'asc'); // Mesajları tarihine göre sıralar, 'desc' kullanırsanız en son gönderilenler ilk gelir
        if($more) {
            $messages->skip($more)
            ->take(10)->get();
        } else {
            $messages->limit(10)->get();
        }
        return $messages;
    }

    public static function deleteMessage(int $message_id) {
        return Message::where('id', $message_id)->where('sender_id', Auth::user()->id)->update(['is_deleted'=>1]);
    }



}