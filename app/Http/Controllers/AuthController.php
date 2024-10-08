<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function handleLogin(Request $request)
    {
        if ($request->isMethod('get')) {
            // GET isteği: giriş formunu döndür
            if (Auth::check()) {
                if (Auth::user()->Role == '1'){
                    return redirect()->route('/admin');
                }
                return redirect()->intended('/'); // Yönlendirilecek sayfa
            }
            return view('login');
        }

        if ($request->isMethod('post')) {
            // POST isteği: giriş işlemini gerçekleştir
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Kimlik doğrulama başarılı
                $request->session()->regenerate(); // Oturumun yeniden oluşturulması

                return redirect()->intended('/admin'); // Başarıyla giriş yaptıktan sonra yönlendirme
            }

            // Kimlik doğrulama başarısız
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }
}
