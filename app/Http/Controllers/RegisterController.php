<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {

        $request->request->add([
            'username' => Str::slug($request->username)
        ]);
        
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required|min:6|max:20|confirmed'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=> $request->username,
            'password'=>Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password')); 

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
