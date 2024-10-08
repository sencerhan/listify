<?php

namespace App\Http\Service\Ad;

use App\Models\Admin\Language;
use App\Models\Admin\Ad;
use App\Models\Admin\AdsDetail;
use App\Http\Service\Category\IndexService as CatIndex;
use App\Http\Service\LanguageService;
use App\Models\Admin\AdToCategory;

class EditService
{
    public static function edit($request)
    {
        $ad = Ad::findOrFail($request->id);
        $categories = CatIndex::getAll();
        $languages = LanguageService::getAll();
        foreach ($languages as $language) {
            $details[$language->id] = AdsDetail
                ::where("ad_id", $ad->id)
                ->where("language_id", $language->id)
                ->first();
        }
        $selectedCategories = AdToCategory::where('ad_id', $ad->id)->pluck('category_id')->toArray();
        //dd($selectedCategories);
        $ad->details = $details;
        $data['ad'] = $ad;
        $data['languages'] = $languages;
        $data['categories'] = $categories;
        $data['selectedCategories'] = $selectedCategories;
        //dd($data);
        return view("admin.ad.edit")->with($data);
    }
    public static function update($request, $id)
    {
        validator($request->all(), [
            'name.*' => 'required|string|max:255',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_keywords.*' => 'nullable|string|max:255',
            'meta_description.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'slug.*' => 'required|string|max:255|ads_details,slug',
            'parent_ids.*' => 'required|integer|exists:categories,id',
            'sort_order' => 'nullable|integer',
        ]);
        $ad = Ad::findOrFail($id);
        $ad->sort_order = $request->sort_order;
        $ad->currency_id = 1;
        $ad->price = $request->price;
        $ad->save();
        if ($request->category_ids) {
            AdToCategory::where('ad_id', $ad->id)->delete();
            foreach ($request->category_ids as $category_id) {
                $adToCategory = new AdToCategory();
                $adToCategory->category_id = $category_id;
                $adToCategory->ad_id = $ad->id;
                $adToCategory->save();
            }

            $languages = LanguageService::getAll();
            foreach ($languages as $language) {
                $query = AdsDetail::where('language_id', $language->id)->where('ad_id', $ad->id)->first();
                if (!$query) {
                    $ad_detail = new AdsDetail();
                } else {
                    $ad_detail = $query;
                }
                $ad_detail->name = $request->name[$language->id];
                $ad_detail->meta_title = $request->meta_title[$language->id];
                $ad_detail->meta_keywords = $request->meta_keywords[$language->id];
                $ad_detail->meta_description = $request->meta_description[$language->id];
                $ad_detail->description = $request->description[$language->id];
                $ad_detail->slug = $request->slug[$language->id];
                $ad_detail->ad_id = $ad->id;
                $ad_detail->language_id = $language->id;
                $ad_detail->save();
            }

            return redirect()->route('admin.ad.index')->with('success', 'Basariyla Eklenmistir');
        }
    }
}
