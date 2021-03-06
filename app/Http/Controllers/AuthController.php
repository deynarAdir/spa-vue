<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){
    	$this->middleware('jwt',['except' => ['login']]);
    }

    public function login(Request $request){
    	$credentials = request(['email','password']);
    	if(! $token = auth('api')->attempt($credentials)){
    		return response()->json(["error" => 'Inautorizado'],401);
    	}
    	return $this->responseWithToken($token);
    }

    public function me(){
    	return response()->json(auth('api')->user());
    }

    public function logout(){
    	auth('api')->logout();
    	return response()->json(["message" => "Successfully logout"]);
    }

    public function refresh (){
    	return $this->responseWithToken(auth('api')->refresh());
    }

    public function responseWithToken($token){
    	return response()->json([
    		'access_token' => $token,
    		'user' => $this->guard()->user(),
    		'token_type' => 'bearer',
    		'expires_in' => auth('api')->factory()->getTTL() * 60
    	]);
    }
    public function guard(){
    	return Auth::guard('api');
    }
}
