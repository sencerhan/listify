<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/ 

Route::middleware(Site::class)->group(function () {
    Route::match(['get', 'post'], '/login', [AuthController::class, 'handleLogin'])->name('login');
    Route::get('/', [indexController::class, 'index'])->name('site.index');
    Route::post('/message/insert', [MessageController::class, 'insert'])->name('message.insert');
    Route::post('/message/update', [MessageController::class, 'update'])->name('message.update');
    Route::post('/message/delete', [MessageController::class, 'delete'])->name('message.delete');
    Route::get('/message/check', [MessageController::class, 'check'])->name('message.check');


});
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
}); 
Route::prefix('admin')->middleware(Admin::class)->group(function () {
    
    Route::get('/', [AdminIndexController::class, 'index'])->name('admin.index');
    Route::post('/language/checkcode', [LanguageController::class, 'checkCode'])->name('admin.language.checkcode');
    Route::get('/language/add', [LanguageController::class, 'add'])->name('admin.language.add');
    Route::post('/language/insert', [LanguageController::class, 'insert'])->name('admin.language.insert');
    Route::get('/language/edit/{id}', [LanguageController::class, 'edit'])->name('admin.language.edit');
    Route::get('/language/delete/{id}', [LanguageController::class, 'delete'])->name('admin.language.delete');
    Route::post('/language/update/{id}', [LanguageController::class, 'update'])->name('admin.language.update');
    Route::get('/language', [LanguageController::class, 'index'])->name('admin.language.index');
    Route::get('/category', [CategoryController::class,'index'])->name('admin.category.index');
    Route::get('/category/add', [CategoryController::class,'add'])->name('admin.category.add');
    Route::post('/category/insert', [CategoryController::class,'insert'])->name('admin.category.insert');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');    
    Route::get('/ad', [AdController::class,'index'])->name('admin.ad.index');
    Route::get('/ad/add', [AdController::class,'add'])->name('admin.ad.add');
    Route::post('/ad/insert', [AdController::class,'insert'])->name('admin.ad.insert');
    Route::get('/ad/delete/{id}', [AdController::class, 'delete'])->name('admin.ad.delete');
    Route::get('/ad/edit/{id}', [AdController::class, 'edit'])->name('admin.ad.edit');
    Route::post('/ad/update/{id}', [AdController::class, 'update'])->name('admin.ad.update');

});