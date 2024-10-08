<?php

namespace App\Http\Service\Category;

use App\Http\Service\LanguageService;
use App\Models\Admin\CategoryDetail;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateService
{
    public static function add(Request $request)
    {
        $data['languages'] = LanguageService::getAll();
        $data['categories'] = IndexService::getAll();
        return view("admin.category.add")->with($data);
    }

    public static function insert(Request $request){
         $request->validate([
            'name.*' => 'required|string|max:255',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_keyword.*' => 'nullable|string|max:255',
            'meta_description.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'slug.*' => 'required|string|max:255|unique:category_details,slug',
            'parent_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ]);
        $languages = LanguageService::getAll();
        $category = new Category();
        $category->sort_order = $request->sort_order;
        $category->parent_id = $request->parent_id;
        $category->save();
        foreach ($languages as $language){
            $category_detail = new CategoryDetail();
            $category_detail->name = $request->name[$language->id];
            $category_detail->category_id = $category->id;
            $category_detail->language_id = $language->id;
            $category_detail->meta_title = $request->meta_title[$language->id];
            $category_detail->meta_description = $request->meta_description[$language->id];
            $category_detail->meta_keywords = $request->meta_keywords[$language->id];
            $category_detail->slug = $request->slug[$language->id];
            $category_detail->description = $request->description[$language->id];
            $category_detail->save();
        }
        return redirect()->route('admin.category.index')->with('success', 'İşlem başarıyla tamamlandı.');
        
    }
}
