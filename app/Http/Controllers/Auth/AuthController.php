<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    //

    public function __construct(){
        $this->middleware('myAuth');
    }

    public function profile(ImageRequest  $request){

        if ($request->hasFile('photo')){

            $photo = $request->photo ;

            $photoname = time().'-'.$photo->getClientOriginalName();

            $location = public_path('/images/users/'.$photoname);

            Image::make($photo)->save($location) ;

            $user = $request->user() ;

            $user->photo =$photoname ;
            $user->save();

            return new UserResource($user) ;
        }
        return response()->json(null , 404) ;

    }

}
