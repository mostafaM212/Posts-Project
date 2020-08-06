<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response ;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    //


    public function store(ProfileRequest $request){

          $profile = Profile::create([
                'userInfo'=>$request->userInfo,
                'address'=>$request->address,
                'user_id'=>$request->user()->id
           ]);
            $profile->save();

        return new ProfileResource($request->user());
    }

    public function index(Request $request){
        return new ProfileResource($request->user());
    }

    public function update(Request $request){

        $user = $request->user();

        $profile = $user->profile->update([
            'userInfo'=>$request->userInfo,
            'address'=>$request->address
        ]) ;

//        $profile->userInfo = $request->userInfo ;



        return new ProfileResource($user);

    }

}
