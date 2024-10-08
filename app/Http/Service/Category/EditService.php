<?php

namespace App\Http\Service\Category;

use App\Http\Service\LanguageService;
use App\Models\Admin\CategoryDetail;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


class EditService{
    public static function edit($request){
        $category = Category::findOrFail($request->id);
        $categories = IndexService::getAll();
        $languages = LanguageService::getAll();
        foreach ($languages as $language){
            $details[$language->id] = CategoryDetail
            ::where("category_id",$category->id)
            ->where("language_id", $language->id)
            ->first();
        }
        $category->details = $details;
        $data['category'] =$category;
        $data['languages'] =$languages;
        $data['categories'] = $categories;
        return view('admin.category.edit')->with($data);
    }
    public static function update($request, $id){
        $category = Category::findOrFail($id);
        foreach ($request->input('name') as $languageId => $name) {
            $categoryDetail = $category->details()->where('language_id', $languageId)->first();
            if ($categoryDetail) {
                $categoryDetail->name = $name;
                $categoryDetail->save();
            }
        }

    }
}
        
    