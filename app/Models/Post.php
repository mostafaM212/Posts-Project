<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title','user_id','body','category_id','photo'
    ];

    public function category(){

        return $this->belongsTo(Post::class) ;
    }

    public function user(){

        return $this->belongsTo(User::class) ;
    }

    public function likes(){

        return $this->hasMany(Likes::class) ;
    }
}
