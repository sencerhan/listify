<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $guarded = ['*'];
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'ad_to_category', 'category_id', 'ad_id');
    }
    public function details(){
        return $this->hasOne(CategoryDetail::class, 'category_id');
    }
}
