<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Services\LoginServices;

class AdminController extends Controller
{
    protected LoginServices $service;

    function __construct(LoginServices $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return view('login');
    }

    public function login(AdminRequest $request)
    {
        $result = $this->service->loginProcess($request);


        if($result){
            return redirect()->route('dashboard')->with('success', 'You have successfully logged in');
        }

        return redirect()->route('login.index')->with('error', 'Credentials not matched');
    }
}
