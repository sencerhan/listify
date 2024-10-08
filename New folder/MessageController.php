<?php

namespace App\Http\Controllers;

use App\Http\Services\MessageService;
use App\Models\ChatUserList;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MessageController extends Controller
{
    public function checkNew(Request $request)
    {
        $count = Message::where("receiver_id", Auth::id())->where("is_seen", 0)->count();
        if ($count) {
            if ($request->id) {
                $messages = MessageService::getNewMessagesByUserId($request->id);
                if ($messages->first()) {
                    $ids = $messages->pluck("id")->toArray();
                    Message::whereIn("id", $ids)->update(
                        [
                            "is_seen" => 1
                        ]
                    );
                    ChatUserList::where("list_owner", Auth::id())->where("user_id", $request->id)->update(
                        [
                            "new" => 0
                        ]
                    );
                    $messagesHtml = View::make("messages")->with(['messages' => $messages])->render();
                    $data['messagesHtml'] = $messagesHtml;
                    $data['newMessage'] = 1;
                }
            }

            $data["status"] = 1;
            $data["count"] = $count;

            $userList = MessageService::getMyChatUserList();
            $chatUserListHtml = View::make("chatUserList")->with(['myChatUserList' => $userList])->render();
            $data['chatUserListHtml'] = $chatUserListHtml;

            return json_encode($data);
        }
        return json_encode(['status' => 0]);
    }
    public function getMessagesByUserId(Request $request)
    {
        $messages = MessageService::getMessagesByUserId($request->userId);
        if ($messages->first()) {
            foreach ($messages as $message) {
                if ($message->sender_id == Auth::id()) {
                    $message->from = "me";
                } else {
                    $message->from = null;
                }
            }

            $html = View::make('messages')->with(['messages' => $messages])->render();
            $userList = MessageService::getMyChatUserList();
            $chatUserListHtml = View::make("chatUserList")->with(['myChatUserList' => $userList])->render();

            return json_encode([
                "status" => 1,
                "chatUserListHtml" => $chatUserListHtml,
                "html" => $html
            ]);
        }
        return json_encode(['status' => 0]);
    }
    public function send(Request $request)
    {
        $message = MessageService::send($request->receiver_id, $request->message);
        if ($message) {
            $html = View::make('message')->with(['message' => $message])->render();
            return json_encode(['status' => 1, 'html' => $html]);
        }
        return json_encode(['status' => 0]);
    }
    public function delete(Request $request)
    {
        $delete = MessageService::delete($request->id);
        if ($delete) {
            return json_encode(['status' => 1]);
        }
        return json_encode(['status' => 0]);
    }
}
