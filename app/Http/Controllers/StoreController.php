<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $posts = Post::OrderBy('updated_at', 'desc')->get();
        return view('store.main', [
            'posts' => $posts
        ]);
    }
}
