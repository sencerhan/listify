<?php

namespace App\Http\Service\Category;

use App\Models\Admin\Language;
use App\Models\Category;

class IndexService
{
    public static function getAll()
    {
        $language = Language::where("default", "1")->first();
        $category = Category::whereNot("is_deleted", true)
            ->with([
                'details' => function ($query)
                use ($language) {
                    $query->where('language_id', $language->id);
                }
            ])->get();
        //dd($category);
        return $category;
    }
}
