<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->title,
        'body'=>$faker->text,
        'category_id'=>factory(\App\Models\category::class)->create()->id
    ];
});
