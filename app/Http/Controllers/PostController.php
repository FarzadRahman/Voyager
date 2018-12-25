<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts=Post::get();

        return $posts;
    }

    public function get($slug){
//        return $slug;
        $post=Post::where('slug',$slug)
            ->first();
        return $post;
    }
}
