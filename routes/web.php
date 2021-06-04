<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        // with method solves the n+1 problem
        // 'posts' => Post::latest()->with('category','author')->get() 

        // Alternate method for solving n+1 problem, also see the App\Models\Post file
        'posts' => Post::latest()->get() 
    ]);
});

Route::get('posts/{post:slug}', function(Post $post){
    return view('post', [
        'post'=> $post
    ]);
});

Route::get('categories/{category:slug}', function (Category $category){
    return view('posts', [
        // load method solves the n+1 problem for specific page types
        // 'posts' => $category->posts->load(['category', 'author'])
        
        // Alternate method for solving n+1 problem, also see the App\Models\Post file
        'posts' => $category->posts
    ]);
});

Route::get('authors/{author:username}', function (User $author){
    return view('posts', [
        // load method solves the n+1 problem for specific page types
        // 'posts' => $author->posts->load(['category', 'author'])
        // Alternate method for solving n+1 problem, also see the App\Models\Post file
        'posts' => $author->posts
    ]);
});
