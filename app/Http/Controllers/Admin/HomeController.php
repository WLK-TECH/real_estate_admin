<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $superAdmins = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'super admin');
        })->count();
        $admins = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();
        $users = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        return view('backend.dashboard', compact('superAdmins' ,'admins', 'users'));
    }
}
