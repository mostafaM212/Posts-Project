<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'userInfo','image','address','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id') ;
    }
}
