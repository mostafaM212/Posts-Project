<?php

namespace Tests\Feature\Post;

use App\Models\category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @group  post1
     */
    public function test_it_returns_posts()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->json('get','api/post');

        $response->assertJsonFragment(['title'=>$post->title]);
    }

    /**
     * @group post2
     *
     */
    public function test_user_must_be_auth_to_store_post(){

        $response = $this->json('post','api/post')->assertStatus(401);
    }

    /**
     * @group post3
     *
     */
    public function test_title_is_required(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'body'=>'454rfrgrgr5','category_id'=>1 ,'user_id'=>$user->id
        ])->assertStatus(422);
    }
    /**
     * @group post4
     *
     */
    public function test_body_is_required(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'title'=>'mostafa','category_id'=>1 ,'user_id'=>$user->id
        ])->assertStatus(422);
    }
    /**
     * @group post5
     *
     */
    public function test_category_id_is_required(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'title'=>'mostafa','body'=>'454rfrgrgr5' ,'user_id'=>$user->id
        ])->assertStatus(422);
    }
    /**
     * @group post6
     *
     */
    public function test_category_id_is_must_be_in_categories(){
        $user = factory(User::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'title'=>'mostafa','body'=>'454rfrgrgr5','category_id'=>1 ,'user_id'=>$user->id
        ])->assertStatus(422);
    }

    /**
     * @group post7
     *
     */
    public function test_it_can_store_post(){
        $user = factory(User::class)->create();
        $category = factory(category::class)->create();
        $response = $this->jsonAs($user,'api/post','post',[
            'title'=>'mostafa','body'=>'454rfrgrgr5','category_id'=>$category->id ,'user_id'=>$user->id
        ]);

        $response->assertJsonFragment(['title'=>'mostafa']);
    }

    /**
     * @group post8
     *
     */
    public function test_it_can_update_post(){
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/post/'.$post->id,'put',[
            'title'=>'mostafa','body'=>'454rfrgrgr5'
        ]);

        $response->assertJsonFragment(['title'=>'mostafa']);
    }

    /**
     * @group post9
     *
     */
    public function test_it_can_show_post(){
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/post/'.$post->id,'get');

        $response->assertJsonFragment(['title'=>$post->title]);
    }

    /**
     * @group post10
     *
     */
    public function test_it_can_delete_post(){
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/post/'.$post->id,'delete');

        $response->assertStatus(200);
    }

}
