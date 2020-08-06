<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Likes::class, function (Faker $faker) {
    return [
        //
        'like'=>$faker->boolean ,
        'post_id'=> factory(\App\Models\Post::class)->create([
            'user_id'=>factory(\App\Models\User::class)->create()->id
        ])->id
    ];
});
