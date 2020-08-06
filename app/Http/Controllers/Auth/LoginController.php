<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\traits\AddToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //

    use AddToken ;

    public function __construct()
    {
        $this->middleware('myAuth')->only(['logout','getUser']);
    }


    public function login(LoginRequest $request){
        $token = Auth::attempt($request->only(['password','email'])) ;

        return $this->addtoken($request->user(),$token);
    }



    public function logout(){

        Auth::logout();
    }

    public function getUser(Request $request){

        return new UserResource($request->user());
    }

}
