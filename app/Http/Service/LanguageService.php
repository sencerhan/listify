<?php

namespace App\Http\Service;

use App\Models\Admin\Language;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class LanguageService
{

    public static function getAll()
    {
        $languages = Language::whereNot('is_deleted', true)->get();
        $languages = Cache::rememberForever('languages', function() {
            return Language::whereNot('is_deleted', true)->get();
        });
        return $languages;
    }
    public static function checkCode($code)
    {
        $code = Language::where('code', $code)->first();
        return $code;
    }
    public static function findOrFail(Language $language){
        $language = Language::where('code', $language->code)->first();
        if($language){
            return $language;
        }
        throw new ModelNotFoundException('Language not found.');    
    }
}
