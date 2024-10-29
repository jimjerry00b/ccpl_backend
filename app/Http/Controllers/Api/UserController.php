<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUdateRequest;
use App\Models\User;
use App\Services\LoginServices;
use App\Services\UserRegistraionServices;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Passport\Token;

class UserController extends Controller
{
    protected UserRegistraionServices $service;

    function __construct(UserRegistraionServices $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        $users = User::select('id', 'name', 'email')->paginate(10);

        if(count($users) > 0){
            return response()->json([
                'status' => true,
                'data' => $users
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message'  => 'No user found'
        ], 500);
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request){

        try {
            $this->service->userRegistration($request);
            return response()->json([
                'status' => true,
                'message' => 'Data inserted'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message'  =>$e->getMessage()
            ], $e->getCode());
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json([
                'status' => true,
                'data'  => $user
            ], 200);
        } catch (Exception $e) {
            response()->json([
                'status' => false,
                'message'  => "Wrong"
            ], 500);
        }
    }

    public function edit(User $user)
    {
        try {
            return response()->json([
                'status' => true,
                'data'  => $user
            ], 200);
        } catch (Exception $e) {
            response()->json([
                'status' => false,
                'message'  => "Wrong"
            ], 500);
        }
    }

    public function update(UserUdateRequest $request, User $user)
    {



        try {
            $this->service->updateUser($request->validated(), $user);

            return response()->json([
                'status' => true,
                'message'  => 'Data updated'
            ], 200);

        }
        catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message'  => "Something wrong"
            ], 500);
        }

    }


    public function destroy(User $user)
    {

        try{
            $this->service->deleteUser($user);
            return response()->json([
                'status' => true,
                'message'  => 'Data deleted'
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message'  => "Something wrong"
            ], 500);
        }

    }


    public function login(AdminRequest $request)
    {

        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            return $user->createToken('mytoken')->accessToken;
        }

        return response()->json([
            'status' => false,
            'message'  => "Credentials not matched"
        ], 500);
    }


    public function logout(Request $request)
    {

        $user = $request->user();

        // Revoke all tokens for the user
        $user->tokens()->each(function (Token $token) {
            $token->revoke();
        });

        return response()->json([
            'status' => true,
            'message'  => 'Successfully logged out'
        ], 200);
    }


}
