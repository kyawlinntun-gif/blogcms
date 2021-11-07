<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        return view('post.main');
    }

    public function create()
    {
        $categories = [];

        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }

        return view('post.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|min:3|max:20',
            'author' => 'required|min:3|max:20',
            'image' => 'required|mimes:jpg,png,jfif',
            'short_desc' => 'required|min:20|max:50',
            'description' => 'required|min:50|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect('/posts/create')->withInput()->withErrors($validator);
        }

        Post::create(['category_id' => $request->category_id, 'title' => $request->title, 'author' => $request->author, 'short_desc' => $request->short_desc, 'description' => $request->description]);

        return redirect('/posts/create');
    }
}
