<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Spatie\Permission\Models\Permission;
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
        return view('user.role.addrole');
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findById($id);
        $rolePermissions = $role->getAllPermissions();
        // dd($role);
        return view('user.role.editrole',compact('role','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // dd($request->permission);
        $request->validate([
            'name' => ['required',ValidationRule::unique('roles','name')->ignore($role->id)],
            'permission' => 'required'
        ]);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permission);
        session()->flash('successpermission','Role Updated');

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
