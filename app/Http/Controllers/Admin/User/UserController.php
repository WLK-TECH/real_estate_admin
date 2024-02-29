<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo("list users")){
            $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->latest()
            ->paginate(5);
            // return $users;
            return view('backend.users.user.index', compact('users'));
        }else{
            abort(403, 'You have not authorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.users.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('user');
        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        if(Auth::user()->hasPermissionTo('edit users')){
            $roles = Role::where('name', '!=', 'super admin')->get();
            return view('backend.users.user.edit', compact('user', 'roles'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->hasPermissionTo('edit users')){
            $request->validate([
                'name'=> 'required',
                'email'=> 'nullable|email|unique:users,email',
            ]);
            $user->update([
                'name'=> $request->name,
                'email'=> $request->email ?? $user->email
            ]);
            $user->roles()->sync($request->roles);
            return redirect(route('users.index'))->with('success','User Updated.');

        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->hasPermissionTo('delete users')){
            $user = User::findOrFail($id);
            $user->delete();
            return redirect(route('users.index'))->with('success','User Deleted.');
        }
    }
}
