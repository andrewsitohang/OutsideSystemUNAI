<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('mahasiswa')->attempt($credentials)) 
        {
            if (Auth::guard('biro_kemahasiswaan')->check()) {
                Auth::guard('biro_kemahasiswaan')->logout();
            }
            
            if (Auth::guard('penjamin')->check()) {
                Auth::guard('penjamin')->logout();
            }

            $request->session()->regenerate();
                
            return redirect()->intended('/mhs/dashboard');
        }

        return back()->with('loginError', 'Kombinasi NIM dan Password Tidak Cocok!!');
    }
    
    public function logout()
    {
        if (Auth::guard('biro_kemahasiswaan')->check()) {
            Auth::guard('biro_kemahasiswaan')->logout();
        }

        if (Auth::guard('penjamin')->check()) {
            Auth::guard('penjamin')->logout();
        }

        if (Auth::guard('mahasiswa')->check()) {
            Auth::guard('mahasiswa')->logout();
        }

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('mhs/login');
    }
}