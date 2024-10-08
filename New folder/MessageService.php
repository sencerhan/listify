<?php

namespace App\Http\Services;

use App\Models\ChatUserList;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageService
{

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

    public static function send(int $receiver_id, string $messageContent)
    {
        if ($receiver_id == Auth::id()) {
            exit;
        }
        $message = new Message();
        $message->receiver_id = $receiver_id;
        $message->message = $messageContent;
        $message->sender_id = Auth::user()->id;
        $message->save();
        if ($message) {
            ChatUserList::updateOrCreate(
                [
                    "list_owner" => $receiver_id,
                    "user_id" => Auth::id()
                ],
                [
                    "new" => Message::where("receiver_id", $receiver_id)->where("sender_id", Auth::id())->where("is_seen", 0)->count()
                ]
            );
            return $message;
        }
        return false;
    }

    public static function getMyChatUserList()
    {
        return ChatUserList::with("user")->where("list_owner", Auth::id())->orderBy("updated_at", "DESC")->get();
    }

    public static function getMessagesByUserId(int $user_id, $more = null)
    {
        $messages = Message::where(function ($query) use ($user_id) {
            $query->where('receiver_id', $user_id)
                ->where('sender_id', Auth::id())
                ->where('deletedBySender', 0);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('sender_id', $user_id)
                ->where('receiver_id', Auth::id())
                ->where('deletedByReceiver', 0);
        })->orderBy('id', 'asc');

        if ($more) {
            $messages =  $messages->skip($more)->take(50)->get();
        } else {
            $messages =  $messages->limit(50)->get();
        }

        foreach ($messages as $message) {
            if ($message->receiver_id == Auth::id()) {
                $message->is_seen = 1;
                $message->save();
            }
        }
        ChatUserList::where("list_owner", Auth::id())->where("user_id", $user_id)->update([
            'new' => 0
        ]);
        return $messages;
    }
    public static function getNewMessagesByUserId(int $user_id)
    {
        $messages = Message::where('sender_id', $user_id)
            ->where('receiver_id', Auth::id())->where("is_seen", 0)->orderBy('id', 'asc')->limit(50)->get();
        foreach ($messages as $message) {
            $message->is_seen = 1;
            $message->save();
        }
        return $messages;
    }

    public static function delete(int $messageId)
    {
        $message = Message::find($messageId);
        if ($message) {
            if ($message->receiver_id == Auth::id()) {
                $message->deletedByReceiver = 1;
                $message->save();
                return 1;
            }
            if ($message->sender_id == Auth::id()) {
                $message->deletedBySender = 1;
                $message->save();
                return 1;
            }
        }
    }
}
