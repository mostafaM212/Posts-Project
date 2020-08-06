<?php

namespace Tests\Feature\Profile;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_add()
    {
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/profile','post',['userInfo'=>'ef','address'=>'dse']);

        $response->assertJsonFragment(['userInfo'=>'ef']);
    }

    public function test_userInfo_is_requird(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/profile','post');

        $response->assertJsonStructure(['userInfo'=>[]]);

    }

    public function test_address_is_requird(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/profile','post');

        $response->assertJsonStructure(['address'=>[]]);

    }
    public function test_it_shows_dataprofile(){
        $user = factory(User::class)->create();
        $profile = Profile::create(['userInfo'=>'frr','address'=>'rrgrg','user_id'=>$user->id]);
        $response = $this->jsonAs($user,'api/profile','get');

        $response->assertJsonFragment(['userInfo'=>'frr']);

    }

    /**
     * @group test_user_can_update_profile
     */
    public function test_user_can_update_profile(){

        $user = factory(User::class)->create();


        factory(Profile::class)->create([
            'user_id'=>$user->id
        ]);

        $res =$this->jsonAs($user ,'api/profile/'.$user->id,'put',['userInfo'=>'mostafa','address'=>'rgr']);

        $res->assertJsonFragment(['address'=>'rgr']);

    }
}
