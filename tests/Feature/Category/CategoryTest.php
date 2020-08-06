<?php

namespace Tests\Feature\Category;

use App\Models\category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @group Category1
     */
    public function test_it_returns_all_posts()
    {
        $user = factory(User::class)->create();
        $category = factory(category::class)->create();
        $response = $this->jsonAs($user,'/api/category','get') ;

        $response->assertJsonFragment(['name'=>$category->name]);
    }

    /**
     * @group category2
     */
    public function test_user_must_be_auth_to_store_category(){

        $response = $this->json('post','api/category')->assertStatus(401);
    }

    /**
     * @group category3
     */
    public function test_name_is_requiered(){

        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'/api/category','post' )->assertStatus(422) ;
    }

    /**
     * @group category4
     */
    public function test_user_can_store_category(){

        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'/api/category','post',[
            'name'=>'mostafa'
        ] ) ;
        $response->assertJsonFragment(['name'=>'mostafa']);
    }

    /**
     * @group category5
     */
    public function test_user_can_delete_category(){

        $user = factory(User::class)->create();
        $category = factory(category::class)->create();
        $response = $this->jsonAs($user,'/api/category/'.$category->id,'delete' ) ;

        $response->assertStatus(200);
    }
}
