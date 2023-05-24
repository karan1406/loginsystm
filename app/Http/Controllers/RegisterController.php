<?php

namespace App\Http\Controllers;
use App\Models\RegisterModel;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.register');
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3|max:50|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);


        $user = User::create($data);
        $user->assignROle('visitor');
        session()->flash('success','Your account has been created..');
        return redirect('/login');
    }

}
