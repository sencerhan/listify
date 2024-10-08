<?php

namespace App\Http\Controllers;

use App\Http\Service\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class MessageController extends Controller
{
    //\
    public function insert(Request $request)
    {
        $message = $request->message;
        $receiver = $request->receiver_id;
        $send = MessageService::send($receiver, $message);
        if ($send) {
            $data['messages'] = MessageService::getMessagesByUserId($receiver);
            $data['status'] = 1;
            return json_encode($data);
        }
    }

    
}
