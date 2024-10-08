<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdToCategory extends Model
{
    use HasFactory;
    protected $table = "ads_to_category";
    protected $guarded = [];
    public function ad(){
        /*
            $table->id();
            $table->integer("ad_id");
            $table->integer("category_id");
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        */
        return $this->belongsTo(Ad::class, "ad_id");
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
