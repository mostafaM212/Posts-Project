<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_has_validation_error_for_email()
    {
        $response = $this->post('/api/register');

        $response->assertJsonStructure(['email'=>[]]);
    }
    public function test_it_has_validation_error_for_name()
    {
        $response = $this->post('/api/register');

        $response->assertJsonStructure(['name'=>[]]);
    }
    public function test_it_has_validation_error_for_password()
    {
        $response = $this->post('/api/register');

        $response->assertJsonStructure(['password'=>[]]);
    }
    public function test_it_returns_data_for_user()
    {
        $user = ['name'=>'mostafa','email'=>'123@frr','password'=>'5654'];
        $response = $this->post('/api/register',$user);

        $response->assertJsonFragment(['name'=>$user['name']]);
    }

    public function test_it_returns_photo_for_user()
    {
        $user = ['name'=>'mostafa','email'=>'123@frr','password'=>'5654'];
        $response = $this->post('/api/register',$user);

        $response->assertJsonFragment(['photo'=>asset('/images/users')]);
    }
}
