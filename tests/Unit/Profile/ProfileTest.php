<?php

namespace Tests\Unit\Profile;

use App\Models\Profile;
use App\Models\User;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @group updateProfile
     */
    public function test_it_update_data()
    {
        $user = factory(User::class)->create();


        factory(Profile::class)->create([
            'user_id'=>$user->id
        ]);

        $res =$this->jsonAs($user ,'api/profile/'.$user->id,'put',['userInfo'=>'mostafa','address'=>'rgr']);

        $this->assertDatabaseHas('profiles',['userInfo'=>'mostafa']) ;
    }
}
