<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication , RefreshDatabase;

    public function jsonAs(User $user , $url ,$method,$data=[]){

        $token = Auth::login($user);

        $response = $this->json($method ,$url,$data ,['Bearer Token'=>$token]);

        return $response ;

    }
}
