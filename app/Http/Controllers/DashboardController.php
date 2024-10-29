<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('backend.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Logout successfully');
    }
}
