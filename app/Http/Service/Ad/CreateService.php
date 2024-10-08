<?php
/**
 * Summary of namespace App\Http\Service\Ad
 * This Service is to create functions and handle controller easier.
 */
namespace App\Http\Service\Ad;

use App\Http\Service\LanguageService;
use App\Http\Service\Category\IndexService as CategoryIndexService;
use App\Models\Admin\AdToCategory;
use App\Models\Admin\Ad;
use App\Models\Admin\AdsDetail;
use GuzzleHttp\Psr7\Request;

class CreateService
{
    public static function add($request)
    {
        $data['languages'] = LanguageService::getAll();
        $data['categories'] = CategoryIndexService::getAll();
        //dd($data);
        return view("admin.ad.add")->with($data);
    }

    public static function create($request)
    {

        validator($request->all(), [
            'name.*' => 'required|string|max:255',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_keywords.*' => 'nullable|string|max:255',
            'meta_description.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'slug.*' => 'required|string|max:255|ads_details,slug',
            'category_ids.*' => 'required|integer|exists:categories,id'
        ]);
        $ad = new Ad();
        $ad->sort_order = $request->sort_order;
        $ad->currency_id = 1;
        $ad->price = $request->price;
        $ad->save();
        if ($request->category_ids) {
            foreach ($request->category_ids as $category_id) {
                $adToCategory = new AdToCategory();
                $adToCategory->category_id = $category_id;
                $adToCategory->ad_id = $ad->id;
                $adToCategory->save();
            }

            $languages = LanguageService::getAll();
            foreach ($languages as $language) {
                $ad_detail = new AdsDetail();
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

            return redirect()->route('admin.ad.index')->with('success','Basariyla Eklenmistir');
        }
        
    }

}
