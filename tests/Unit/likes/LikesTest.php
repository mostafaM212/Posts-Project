<?php

namespace Tests\Unit\likes;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase ;

class LikesTest extends TestCase
{
    /**
     * @group likeUnit1
     *
     * @return void
     */
    public function test_it_can_store_like()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'api/like','post',[
            'user_id'=>$user->id ,'post_id'=>factory(Post::class)->create([
                'user_id'=>$user->id
            ])->id ,'like'=>'true'
        ]);

       $this->assertDatabaseHas('likes',['user_id'=>$user->id]) ;
    }
}
