<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function details(){
        return $this->hasOne(CategoryDetail::class, 'category_id');
    }

    public function adToCategories(){
        return $this->hasMany(AdToCategory::class,'category_id');
    }

}
