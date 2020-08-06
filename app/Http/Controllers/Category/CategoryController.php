<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('myAuth')->except(['index','show']);
    }

    public function index(){

        $categories = category::with(['posts.user'])->get();

        return CategoryResource::collection($categories) ;
    }
    public function show(category $category){
        return new CategoryResource($category);
    }
    public function store(CategoryRequest $request){

        $category= category::create($request->only('name'));

        return new CategoryResource($category);
    }
    public function destroy (category $category){

        $category->delete();
        return response()->json(null , 200) ;
    }
}
