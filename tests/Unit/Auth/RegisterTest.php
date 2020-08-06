<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_store_data_for_user()
    {
        $user = ['name'=>'mostafa','email'=>'123@frr','password'=>'5654'];
        $response = $this->post('/api/register',$user);
        $this->assertDatabaseHas('users',['name'=>'mostafa']);
    }
}
