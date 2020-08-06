<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;
use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('myAuth');
    }

    public function index(){
        $likes = Likes::all() ;

        return LikeResource::collection($likes) ;
    }

    public function store(LikeRequest $request){

        $likes = Likes::all() ;

        $likes->each(function ($like) use ($request){
            if($like->user->id === $request->user_id && $like->post->id === $request->post_id){
                $likere = Likes::where('user_id',$request->user_id)->where('post_id',$request->post_id)->first() ;
                $likere->delete();
            }
        });

        $like = Likes::create($request->only(['like','user_id','post_id'])) ;

        return new LikeResource($like) ;
    }
}
