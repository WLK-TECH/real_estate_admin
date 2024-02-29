<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can("list permissions")) {
            $permissions = Permission::latest()->get();
            return view('backend.users.permission.index', compact('permissions'));
        }else{
            abort(403,'You have not authorized');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('create permissions')) {
            return view('backend.users.permission.create');
        }else{
            abort(403,'You have not authorized.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('create permissions')) {
            $request->validate([
                'name'=> 'required',
            ]);
            Permission::create([
                'name'=> $request->name,
                'guard_name' => "web"
            ]);
            return redirect()->route('permissions.index')->with('success','New Permission Created');
        }else{
            abort(403,'Forbidden');
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
    public function edit(Permission $permission)
    {
        if (auth()->user()->can('edit permissions')) {
            return view('backend.users.permission.edit', compact('permission'));
        }else{
            abort(403,'Forbidden');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if (auth()->user()->can('edit permissions')) {
            $request->validate([
                'name'=> 'required',
            ]);
            $permission->update([
                'name'=> $request->name,
                'guard_name' => "web"
            ]);
            return redirect()->route("permissions.index")->with("success","Permission Updated");
        }else{
            abort(403,'Forbidden');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (auth()->user()->can('delete permissions')) {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success','Permission Deleted');
        }else{
            abort(403,'Forbidden');
        }
    }
}
