<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id','!=',auth()->id())->with('roles')->get();
        return view('user.adduser',[
            'users' => User::all()->skip(auth()->id()),
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->getRoleNames();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required'
        ]);
        $user->syncRoles([$request->status]);
        $user->update($data);
        session()->flash('successpermission','User details Edited');

    }

    public function updateState(User $user)
    {
        if(request()->state == 'on')
        {
            $user->givePermissionTo(request()->permission);
            session()->flash('successpermission','permission are added');
        }
        else
        {
            $user->revokePermissionTo(request()->permission);
            session()->flash('successpermission','permission are remove');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // dd($user->getRoleNames()[0]);
        $user->removeRole($user->getRoleNames()[0]);
        $user->delete();
        session()->flash('successpermission','User are remove');

        // return view('user.adduser',[
        //     'users' => User::all()->skip(auth()->id())
        // ]);
    }
}
