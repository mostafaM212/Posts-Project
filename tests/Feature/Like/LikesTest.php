<?php

namespace Tests\Feature\Like;

use App\Models\Likes;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesTest extends TestCase
{
    /**
     * @group like1
     *
     * @return void
     */
    public function test_user_must_be_auth()
    {

        $response = $this->get('api/like');

        $response->assertStatus(401);
    }

    /**
     * @group like2
     *
     * @return void
     */
    public function test_it_returns_data_for_like()
    {
        $user = factory(User::class)->create();
        $like = factory(Likes::class)->create([
            'user_id'=>$user->id
        ]);
        $response = $this->jsonAs($user,'api/like','get');

        $response->assertJsonFragment(['like'=>0]);
    }
    /**
     * @group like3
     *
     * @return void
     */
    public function test_it_user_id_must_be_required()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'api/like','post');

        $response->assertJsonStructure(['user_id'=>[]]);
    }

    /**
     * @group like4
     *
     * @return void
     */
    public function test_it_like_must_be_required()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'api/like','post');

        $response->assertJsonStructure(['like'=>[]]);
    }
    /**
     * @group like5
     *
     * @return void
     */
    public function test_it_post_id_must_be_required()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'api/like','post');

        $response->assertJsonStructure(['post_id'=>[]]);
    }

    /**
     * @group like6
     *
     * @return void
     */
    public function test_it_store_data_for_like()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user,'api/like','post',[
            'user_id'=>$user->id ,'post_id'=>factory(Post::class)->create([
                'user_id'=>$user->id
            ])->id ,'like'=>'true'
        ]);

        $response->assertJsonFragment(['like'=>true]);
    }
}
