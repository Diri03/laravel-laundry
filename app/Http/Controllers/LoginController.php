<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function login(){
        return view("login");
    }

    public function actionLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:8'
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        Alert::error('Error Login', 'Invalid Credentials');
        return back()->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}