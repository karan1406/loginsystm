<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('user.role.index', compact('roles'));
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
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permission' => 'required'
            ]);
            $roles = Role::create(['name' =>$request->name]);
            $roles->givePermissionTo($request->permission);
            session()->flash('successpermission','Role Added');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $users = User::role($role->name)->get();
        foreach($users as $user)
        {
                $user->syncRoles('visitor');
        }
        $role->delete();
            session()->flash('successpermission','Role Deleted');
    }

    public function updatepermission(Role $role)
    {
        if(request()->state == 'on')
        {
            $role->givePermissionTo(request()->permission);
            session()->flash('successpermission','permission are added');
        }
        else
        {
            $role->revokePermissionTo(request()->permission);
            session()->flash('successpermission','permission are remove');
        }
    }
}
