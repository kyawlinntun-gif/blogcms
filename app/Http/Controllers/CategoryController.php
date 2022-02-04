<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = Category::all();
        return view('category.main', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20|unique:categories,name'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create(['name' => $request->name]);

        Session::flash('info', 'New category is created!');

        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20|unique:categories,name,'. $category->id
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category->update(['name' => $request->name]);

        Session::flash('info', 'Category is updated!');

        return redirect(url('/categories'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        Session::flash('info', 'Category is deleted!');

        return redirect()->back();
    }
}
