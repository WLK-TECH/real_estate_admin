<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo("list super_admins")){
            $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'super admin');
            })
            ->latest()
            ->get();
            // return $users;
            return view('backend.users.super-admin.index', compact('users'));
        }else{
            abort(403, 'You have not authorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasPermissionTo("create super_admins"))
        {
            return view('backend.users.super-admin.create');
        }else{
            abort(403, 'You have not authorized.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo("create super_admins"))
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:8',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('super admin');
            return redirect()->route('super-admins.index')->with('success', 'Super Admin created successfully.');
        }else{
            abort(403, 'You have not authorized.');
        }
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
        if(Auth::user()->hasPermissionTo('edit super_admins')){
            $superAdmin = User::find($id);
            $roles = Role::latest()->get();
            return view('backend.users.super-admin.edit', compact('superAdmin', 'roles'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasPermissionTo('edit super_admins')){
            $request->validate([
                'name'=> 'required',
                'email'=> 'nullable|email|unique:users,email',
            ]);
            $superAdmin = User::find($id);
            $superAdmin->update([
                'name'=> $request->name,
                'email'=> $request->email ?? $superAdmin->email
            ]);
            $superAdmin->roles()->sync($request->roles);
            return redirect(route('super-admins.index'))->with('success','Super Admin Updated.');

        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->hasPermissionTo('delete super_admins')){
            $superAdmin = User::find($id);
            $superAdmin->delete();
            return redirect(route('super-admins.index'))->with('success','Super Admin Deleted.');
        }else{
            abort(403);
        }
    }
}
