<?php

namespace App\Http\Service\Ad;

use App\Models\Admin\Language;
use App\Models\Admin\Ad;

class IndexService
{
    public static function getAll()
    {
        $language = Language::where("default", "1")->first();
        $ad = Ad::whereNot("is_deleted", true)
            ->with([
                'details' => function ($query)
                use ($language) {
                    $query->where('language_id', $language->id);
                }
            ])->get();
        //dd($ad);
        return $ad;
    }
    
}
