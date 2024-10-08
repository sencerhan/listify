<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = ['*'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ad_to_category', 'ad_id', 'category_id');
    }
}
