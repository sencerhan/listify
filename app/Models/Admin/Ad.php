<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function details(){
        return $this->hasOne(AdsDetail::class, 'ad_id');
    }
    
}
