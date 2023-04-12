<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function doLogIn(Request $request) {
        session()->put('admin', false);

        if (auth('web')->attempt(['login' => $request->get('login'), 'password' => $request->get('password')])) {
            session()->put('admin', true);
            return redirect()->route('admin');
        }
        return redirect()->route('login')->withErrors(['login' => 'Дані введені не коректно']);
    }

    public function doLogOut(){
        session()->put('admin', false);
        auth('web')->logout();

        return redirect()->route('main');
    }
}
