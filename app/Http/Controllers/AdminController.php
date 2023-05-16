<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        $attribute = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($attribute))
        {
            return back()->withErrors(['email' => "Your provided credentials could not be verified"]);
        }
        session()->regenerate();
        return redirect('/admin')->with('success','Welcome Back');
    }
}
