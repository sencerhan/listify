<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\Ad\CreateService as AdCreateService;
use App\Http\Service\Ad\EditService as AdEditService;
use Illuminate\Http\Request;
use App\Http\Service\Ad\IndexService as AdIndexService;
use App\Http\Service\Category\IndexService as CategoryIndexService;
use App\Http\Service\LanguageService;

class AdController extends Controller
{
    //
    public function index(){
        $data['ads'] = AdIndexService::getAll();
        $data['languages'] = LanguageService::getAll();
        $data['categories'] = CategoryIndexService::getAll();
        //$data = collect($data);
        //dd($data);
        return view('admin.ad.index', $data);
        //return view('admin.category.index')->with($data);
        //return view('admin.category.index')->with('categories', $data['categories'])->with('langauges', data['languages']);

    }

    public function add(Request $request){
        
        return AdCreateService::add($request);
    }

    public function insert(Request $request){
        return AdCreateService::create($request);
    }

    public function edit(Request $request){
        //dd($request);
        return AdEditService::edit($request);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name.*' => 'required|string|max:255',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_keyword.*' => 'nullable|string|max:255',
            'meta_description.*' => 'nullable|string|max:255',
            'description.*' => 'nullable|string',
            'slug.*' => 'required|string|max:255|unique:category_details,slug',
            'parent_ids.*'=> 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ]);
        //dd($request->all());
        return AdEditService::update($request, $id);
    }
    public function delete(Request $request){
        //dd($id);
        dd($request->id);
    }
}
