<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;

class LoginServices
{
    /**
     * Create a new class instance.
     */
    function loginProcess($request){

        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            return true;
        }

        return false;

    }
}
