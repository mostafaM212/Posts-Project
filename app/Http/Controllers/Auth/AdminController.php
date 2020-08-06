<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['myAuth','admin']) ;
    }

    public function index(Request  $request){

        $users = User::all();

        return UserResource::collection($users) ;
    }

    public function update(Request  $request , User $user){

        $user->admin = 'admin';
        $user->save();

        return new UserResource( $user ) ;
    }

    public function destroy( User $user){

        $user->delete() ;

        return response()->json(null ,200) ;
    }
}
