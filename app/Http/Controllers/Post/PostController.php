<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image ;
class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('myAuth')->except(['index' ,'show']) ;
    }

    public function index(){

        $posts =Post::with(['user'])->paginate(5);

        return PostResource::collection($posts);
    }

    public function store(PostRequest $request){

        if($request->hasFile('photo')){
            $photo = $request->photo;

            $photoname = time().'-'.$photo->getClientOriginalName();

            $location = public_path('/images/posts/'.$photoname);

            Image::make($photo)->save($location);
            $post = Post::create($this->PostInfo($request,$photoname));

        }else{
            $post = Post::create($this->PostInfo($request));
        }



        return new PostResource($post) ;
    }

    public function show(Post $post){

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request ,Post $post){

        $post->update($request->only(['title','body']));

        return new PostResource($post);
    }

    public function destroy(Post $post){

        $post->delete();
        return response()->json(null,200);
    }

    public function PostInfo(Request $request,$name = 'image.jpg'){

        return [
            'title'=>$request->title,
            'body'=>$request->body,
            'photo'=>$name,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user()->id
        ];
    }

}
