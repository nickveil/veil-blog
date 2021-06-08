<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search']))->get(),
            'categories' => Category::all() 


            // with method solves the n+1 problem
            // 'posts' => Post::latest()->with('category','author')->get() 
    
            // Alternate method for solving n+1 problem, also see the App\Models\Post file
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post'=> $post
        ]);
    }

}
