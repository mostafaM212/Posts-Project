<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    //
    protected $fillable = [
        'like','user_id','post_id'
    ];
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($like){

            $like->like = $like->like === 'true' ? true : false ;
        });
    }

    public function user(){

        return $this->belongsTo(User::class) ;
    }
    public function post(){

        return $this->belongsTo(Post::class);
    }
}
