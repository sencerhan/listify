<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Service\LanguageService;
use App\Models\Admin\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class LanguageController extends Controller
{
    //
    public function index()
    {
        $data['languages'] = LanguageService::getAll();
        return view('admin.language.index')->with($data);
    }

    public function checkCode(Request $request)
    {
        return (LanguageService::checkCode($request->code) ? 1 : 0);
    }
    public function add(Request $request)
    {
        return view('admin.language.add');
    }
    public function insert(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2',
            'flag' => 'required|image',
            'default' => 'nullable|boolean',
        ]);


        // Gelen dosyayı geçici olarak sakla
        $image = $request->file('flag');


        // Kaydedilecek dizin oluşturulmamışsa oluştur
        $directory = 'img';
        if (!is_dir(public_path($directory))) {
            mkdir(public_path($directory), 0775, true);
        }
        $path = $directory . '/' . time() . '.webp';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($image);
        $image->scale(width: 100);
        $image->toWebp();
        $image->save($path);
        $language = Language::create(['name' => $request->name, 'code' => $request->code, 'flag' => $path]);
        
        if ($request->default){
            Language::where('default', 1)->update(['default' => 0]);
            $language->default = $request->default;
            $language->save();
        }
       
        if ($language) {
            Cache::forget('languages');
            return redirect()->route('admin.language.index')->with('success', 'İşlem başarıyla tamamlandı.');
        } else {
            return redirect()->route('admin.language.add')->with('error', 'Kayıt işlemi başarısız. Tekrar deneyiniz.');
        }
    }
    public function edit(Request $request)
    {
        $data['language'] = Language::findOrFail($request->id);
        return view('admin.language.edit')->with($data);
    }
    public function delete(Request $request)
    {
        Language::find($request->id)->update(array('is_deleted' => true));
        return redirect()->route('admin.language.index')->with('success', 'İşlem başarıyla tamamlandı.');
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([

            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2',
            'flag' => 'nullable|image',
            'default' => 'nullable|integer',
        ]);
        $language = Language::findOrFail($request->id);

        // Gelen dosyayı geçici olarak sakla
        $image = $request->file('flag');
        if ($image) {
            // Kaydedilecek dizin oluşturulmamışsa oluştur
            if (file_exists($language->flag)) {
                unlink(public_path($language->flag));
            }
            $directory = 'img';
            if (!is_dir(public_path($directory))) {
                mkdir(public_path($directory), 0775, true);
            }
            $path = $directory . '/' . time() . '.webp';

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image);
                $image->scale(width: 100);
                $image->toWebp();
                $image->save($path);
            } catch (Exception $e) {

                Log::error('Görüntü işlemi sırasında bir hata oluştu: ' . $e->getMessage());
            }
            $language->flag = $path;
        }


        $language->name = $request->name;
        $language->code = $request->code;
        if ($request->default){
            Language::where('default', 1)->update(['default' => 0]);
            $language->default = $request->default;
        }
        else{
            $language->default = 0;
        }
        $language->save();

        if ($language) {
            Cache::forget('languages');
            return redirect()->route('admin.language.index')->with('success', 'İşlem başarıyla tamamlandı.');
        } else {
            return redirect()->route('admin.language.add')->with('error', 'Kayıt işlemi başarısız. Tekrar deneyiniz.');
        }
    }
}
