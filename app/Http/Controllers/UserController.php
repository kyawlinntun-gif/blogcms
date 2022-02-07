<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('edit', 'update');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function edit()
    {
        return view('auth.change_password', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:3|max:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);

        Session::flash('info', 'Password is updated!');

        return redirect(url('/users'));
    }
}
