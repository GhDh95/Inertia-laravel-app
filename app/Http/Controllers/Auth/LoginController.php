<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class LoginController extends Controller
{
    //
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function store()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($credentials)) {
            Session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Wrong email or password'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
