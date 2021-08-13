<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function save(Request $request)
    {
        try
        {
            DB::table('users')->insert(
            ['name'=>$request->input('name'),
             'email'=>$request->input('email'),
             'isAdmin'=>$request->input('isAdmin'),
             'password'=>Hash::make($request->input('password'))]
            );
            
            return response()->json(['user_created'], 200);
        }
        catch(QueryException $ex)
        {
            return response()->json(['internal_error'], 500);
        }
    }

    public function getCurrentUser(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        echo $user;
    }

    public function getCurrentUserDetails(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        echo $user->userDetails;
    }
}
