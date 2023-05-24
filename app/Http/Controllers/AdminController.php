<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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

        if(auth()->user()->hasRole('visitor'))
        {
            return redirect('/');
        }
        else{
        return redirect('/admin')->with('success','Welcome Back');
        }
    }

    public function destroy()
    {
      auth()->logout();
      return redirect('/');
    }
}
