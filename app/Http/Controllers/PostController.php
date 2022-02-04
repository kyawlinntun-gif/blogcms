<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('post.main', [
            'posts' => Post::all()
        ]);
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
            'title' => 'required|min:3|max:50',
            'author' => 'required|min:3|max:20',
            'image' => 'required|mimes:jpg,png,jfif',
            'short_desc' => 'required|min:20|max:100',
            'description' => 'required|min:50|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect('/posts/create')->withInput()->withErrors($validator);
        }

        // Get filename with extension
        $filenameWithExt = $request->file('image')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
        $extension = $request->file('image')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename . '_' . time() . '.' .$extension;

        // Create Path
        $destinationPath = public_path("/img/posts/");

        // Upload image
        $path = $request->file('image')->move($destinationPath, $filenameToStore);

        Session::flash('info', 'Post was created successfully!');

        Post::create(['category_id' => $request->category_id, 'title' => $request->title, 'author' => $request->author, 'image' => $filenameToStore, 'short_desc' => $request->short_desc, 'description' => $request->description]);

        return redirect()->back();
    }

    public function edit(Post $post)
    {
        /* ---------- Start of Category with id ---------- */
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        /* ---------- End of Category with id ---------- */
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|min:3|max:50',
            'author' => 'required|min:3|max:20',
            'short_desc' => 'required|min:20|max:100',
            'description' => 'required|min:50|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect('/posts/'.$post->id.'/edit')->withInput()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png,jfif',
            ]);
    
            if ($validator->fails()) {
                return redirect('/posts/'.$post->id.'/edit')->withInput()->withErrors($validator);
            }

            // Get filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();

            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get extension
            $extension = $request->file('image')->getClientOriginalExtension();

            // Create new filename
            $filenameToStore = $filename . '_' . time() . '.' .$extension;

            // Create Path
            $destinationPath = public_path("/img/posts/");

            // Upload image
            $path = $request->file('image')->move($destinationPath, $filenameToStore);

            // Update image
            $post->update(['image' => $filenameToStore]);
        }

        Session::flash('info', 'Post was updated successfully!');

        $post->update(['category_id' => $request->category_id, 'title' => $request->title, 'author' => $request->author, 'short_desc' => $request->short_desc, 'description' => $request->description]);

        return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $post->delete();

        Session::flash('info', 'Category is deleted!');

        return redirect()->back();
    }
}
