<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\Category\CreateService;
use App\Http\Service\Category\EditService;
use App\Http\Service\Category\IndexService;
use App\Http\Service\LanguageService;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){

        $data['categories'] = IndexService::getAll();
        $data['languages'] = LanguageService::getAll();
        //$data = collect($data);
        //dd($data);
        return view('admin.category.index', $data);
        //return view('admin.category.index')->with($data);
        //return view('admin.category.index')->with('categories', $data['categories'])->with('langauges', data['languages']);

    }

    public function add(Request $request){

        return CreateService::add($request);
    }

    public function insert(Request $request){
        return CreateService::insert($request);
    }

    public function edit(Request $request){
        return EditService::edit($request);
    }
    public function update(Request $request, $id){
        return EditService::update($request, $id);
    }
    public function delete(Request $request){
        //dd($id);
        dd($request->id);
    }
}
