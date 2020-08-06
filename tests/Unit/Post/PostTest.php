<?php

namespace Tests\Unit\Post;

use App\Models\category;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase ;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @group  postUnit1
     */
    public function test_it_can_store_post()
    {
        $user = factory(User::class)->create();
        $category = factory(category::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'title'=>'mostafa','body'=>'454rfrgrgr5','category_id'=>$category->id ,'user_id'=>$user->id
        ]);
        $this->assertDatabaseHas('posts',['title'=>'mostafa']);
    }

    /**
     * A basic unit test example.
     *
     * @group  postUnit2
     */
    public function test_it_can_update_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/post/'.$post->id,'put',[
            'title'=>'mostafa','body'=>'454rfrgrgr5'
        ]);
        $this->assertDatabaseHas('posts',['title'=>'mostafa']);
    }
    /**
     * A basic unit test example.
     *
     * @group  postUnit3
     */
    public function test_it_can_delete_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/post/'.$post->id,'delete');
        $this->assertDatabaseMissing('posts',['title'=>'mostafa']);
    }
}
