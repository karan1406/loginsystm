<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function create()
    {

        $attribute = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($attribute)) {
            return back()->withErrors(['email' => "Your provided credentials could not be verified"]);
        }
        session()->regenerate();

        if (auth()->user()->hasAnyRole(Role::all())) {

            $url = request()->session()->get('url');

            // dd($url['intended']);
            if (request()->session()->get('url')) {
                if (auth()->user()->hasRole('Super Admin')) {
                    Session::forget('url');
                    return redirect($url['intended']);
                }
            } else {
                return redirect('/admin')->with('success', 'Welcome Back');
            }
        } else {
            return redirect('/');
        }
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
