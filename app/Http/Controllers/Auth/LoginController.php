<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    //

    
    public function __construct(){
        
    }
    public function index(){
        return Auth::check() ? redirect()->route('dashboard') :  view('pages.auth.login');
    }
    public function auth(Request $request) {
        $credentials = $request->only('email', 'password');
    
        // Debugging untuk cek input
        \Log::info($credentials);
    
        if (Auth::attempt($credentials)) {
            \Log::info('Login berhasil');
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    
        \Log::info('Login gagal');
        return redirect('login')->with('eror', 'Email atau password salah / tidak terdaftar')->onlyInput('email');
    }
    
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('sukses','Logout Berhasil');
    }
}
