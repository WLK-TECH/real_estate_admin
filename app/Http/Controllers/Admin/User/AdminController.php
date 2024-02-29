<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo("list admins")){
            $roles = Role::all();
            $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->latest()
            ->get();
            // return $users;
            return view('backend.users.admin.index', compact('users', 'roles'));
        }else{
            abort(403, 'You have not authorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasPermissionTo("create admins"))
        {
            return view('backend.users.admin.create');
        }else{
            abort(403, 'You have not authorized.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermissionTo("create admins"))
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('admin');
            return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
        }else{
            abort(403, 'You have not authorized.');
        }
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
        if(Auth::user()->hasPermissionTo('edit admins')){
            $admin = User::find($id);
            $roles = Role::latest()->get();
            return view('backend.users.admin.edit', compact('admin', 'roles'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasPermissionTo('edit admins')){
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
            return redirect(route('admins.index'))->with('success','Admin Updated.');

        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->hasPermissionTo('delete admins')){
            $admin = User::find($id);
            $admin->delete();
            return redirect(route('admins.index'))->with('success','Admin Deleted.');
        }else{
            abort(403);
        }
    }
}
