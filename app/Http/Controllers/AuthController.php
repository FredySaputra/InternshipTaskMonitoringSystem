<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){

    $credentials = $request->validate([
        'username' => ['required','string'],
        'password' => ['required','string']
    ]);

    if(Auth::guard('web')->attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    if(Auth::guard('students')->attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('/student-dashboard');
    }

    return back()->withErrors(['message'=>'Username atau password salah']);
    }

    public function logout(){
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }

        if(Auth::guard('students')->check()){
            Auth::guard('students')->logout();
            return redirect()->route('login');
        }
    }
}
