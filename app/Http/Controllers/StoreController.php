<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $posts = Post::OrderBy('updated_at', 'desc')->get();
        return view('store.main', [
            'posts' => $posts,
            'categories' => Category::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('store.view', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function getPosts(Category $category)
    {
        return view('store.category', [
            'posts' => $category->posts,
            'categories' => Category::all()
        ]);
    }
}
