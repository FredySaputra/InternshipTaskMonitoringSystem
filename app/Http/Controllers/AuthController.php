<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string']
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('username')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['message' => 'Terlalu banyak percobaan. Silakan coba lagi dalam '.$seconds.' detik.']);
        }

        $credentials = $request->only('username', 'password');

        if(Auth::guard('web')->attempt($credentials)){
            RateLimiter::clear($throttleKey); // Clear attempts on success
            $request->session()->regenerate();
            return redirect()->route('task.index');
        }

        if(Auth::guard('students')->attempt($credentials)){
            RateLimiter::clear($throttleKey); // Clear attempts on success
            $request->session()->regenerate();
            return redirect()->intended('/student-dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

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
