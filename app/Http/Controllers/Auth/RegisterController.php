<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\traits\AddToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image ;


class RegisterController extends Controller
{
    //
    use AddToken ;



    public function register(RegisterRequest $request){

        if($request->hasFile('photo')){

            $photo = $request->photo ;

            $photoname = time().'-'. $photo->getClientOriginalName();

            $location = public_path('/images/users/'.$photoname) ;
            Image::make($photo)->save($location);

            $user =  User::create($this->storeUser($request,$photoname));
        }else{
            $user =  User::create($request->only(['name','email','password']));
        }

        $token = Auth::attempt($request->only(['name','email','password']));
        return $this->addtoken($user,$token);
    }

    public function storeUser(RegisterRequest $request , $photoname = 'user.png'){

        return [
            'name'=>$request->name ,
            'email'=>$request->email,
            'password'=>$request->password,
            'photo'=>$photoname
        ];
    }

}
