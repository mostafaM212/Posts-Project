<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @group  admin1
     */
    public function test_it_must_be_auth()
    {
        $response = $this->json('get','api/admin');

        $response->assertStatus(401);
    }

    /**
     * A basic feature test example.
     *
     * @group  admin2
     */
    public function test_it_must_be_an_admin()
    {
        $user = factory(User::class)->create([
            'admin'=>'user'
        ]) ;
        $response = $this->jsonAs($user,'api/admin','get');

        $response->assertStatus(404);
    }
    /**
     * A basic feature test example.
     *
     * @group  admin3
     */
    public function test_it_show_data_for_users()
    {
        $user = factory(User::class)->create([
            'admin'=>'admin'
        ]) ;
        $response = $this->jsonAs($user,'api/admin','get');

        $response->assertJsonFragment(['id'=>$user->id]) ;
    }

    /**
     * A basic feature test example.
     *
     * @group  admin4
     */
    public function test_it_can_update_admin()
    {
        $user = factory(User::class)->create([
            'admin'=>'admin'
        ]) ;
        $user1 = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/admin/'.$user1->id,'put');

        $response->assertJsonFragment(['admin'=>$user->admin]) ;
    }

    /**
     * A basic feature test example.
     *
     * @group  admin5
     */
    public function test_it_can_delete_admin()
    {
        $user = factory(User::class)->create([
            'admin'=>'admin'
        ]) ;
        $user1 = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/admin/'.$user1->id,'DELETE');

        $response->assertStatus(200) ;
    }
}
