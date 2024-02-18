<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can("list roles")) {
            $roles = Role::all();
            return view('backend.user_management.role.index', compact('roles'));
        }else{
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can("create roles")) {
            $permissions = Permission::all();
            return view('backend.user_management.role.create', compact('permissions'));
        }else{
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create roles')) {
            abort(403);
        }else{
            $request->validate([
                'name'=> 'required',
            ]);
            $role = Role::create([
                'name'=> $request->name,
                'guard_name' => "web"
            ]);

            $role->syncPermissions($request->permissions);
            return redirect()->route("role.index")->with("success","New Role Created.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view("backend.user_management.role.show", compact("role"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (auth()->user()->can("edit roles")) {
            $permissions = Permission::all();
            return view('backend.user_management.role.edit', compact("role", "permissions"));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (auth()->user()->can("edit roles")) {
            $request->validate([
                "name"=> "required",
            ]);
            $role->update([
                "name"=> $request->name
            ]);
            $role->syncPermissions($request->permissions);
            return redirect()->route("role.index")->with("success","Role Updated.");
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (auth()->user()->can("delete roles")) {
            $role->delete();
            return redirect()->route("role.index")->with("success","Role Deleted.");
        }else{
            abort(403);
        }
    }
}
