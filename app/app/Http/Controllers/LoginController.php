<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Форма авторизации
     *
     * @return void
     */
    public function loginForm()
    {
        return view('dashboard.login', [
            "page_title" => "Авторизация"
        ]);
    }

    /**
     * Авторизация пользователя
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // dd($request);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Имеил уже существует.',
        ]);
    }


    /**
     * Выход пользователя
     */



    public function logout(Request $request)
    {
        Auth::logout();
        //
        return redirect()->route('dashboard.index');
    }
}
