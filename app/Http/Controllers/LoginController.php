<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view("login");
    }

    public function actionLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:3'
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email'=> 'Invalid Credentials',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}