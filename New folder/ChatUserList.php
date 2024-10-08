<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUserList extends Model
{
    protected $table = "chat_user_list";
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
