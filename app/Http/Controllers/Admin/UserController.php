<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin(){
        $admins = User::where('role', 'admin')->get();
        return view('admin.users.admin',compact('admins'));
    }
}
