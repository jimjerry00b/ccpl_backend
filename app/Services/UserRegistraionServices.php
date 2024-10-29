<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserRegistraionServices
{


    function userRegistration($request){

       try {
        User::create([
            'name'                  => $request['name'],
            'email'                 => $request['email'],
            'password'              => bcrypt($request['password']),
        ]);
       } catch (Exception $e) {
        throw new Exception("Something was wrong.", 500);
       }
    }

    function updateUser($data, $user){

        try {
            $user->update($data);
        } catch (Exception $e) {
            throw new Exception("Something was wrong.", 500);
        }
    }

    function deleteUser($user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            throw new Exception("Something was wrong.", 500);
        }
    }
}
