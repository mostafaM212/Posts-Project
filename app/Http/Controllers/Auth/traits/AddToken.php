<?php


namespace App\Http\Controllers\Auth\traits;


use App\Http\Resources\UserResource;

trait AddToken
{
    public function addtoken($user , $token){

        return (new UserResource($user))->additional([
            'meta'=>[
                'token'=>$token
            ]
        ]);
    }
}
