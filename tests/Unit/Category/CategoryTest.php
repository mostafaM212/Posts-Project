<?php

namespace Tests\Unit\Category;

use App\Models\category;
use App\Models\User;
use Tests\TestCase ;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @group  categoryUnit1
     */
    public function test_it_can_store_test()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'/api/category','post',[
            'name'=>'mostafa'
        ] ) ;
        $this->assertDatabaseHas('categories',['name'=>'mostafa']);
    }

    /**
     * A basic unit test example.
     *
     * @group  categoryUnit2
     */
    public function test_it_can_delete_test()
    {
        $user = factory(User::class)->create();
        $category = factory(category::class)->create();
        $response = $this->jsonAs($user,'/api/category/'.$category->id,'delete') ;

        $this->assertDatabaseMissing('categories',['name'=>'mostafa']);
    }
}
