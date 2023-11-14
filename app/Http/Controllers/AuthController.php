<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(auth()->user()->role == "admin"){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('home');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
