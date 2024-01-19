<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        Like::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]); 

        return back();

    }

    public function destroy(Request $request, Post $post)
    {
        auth()->user()->likes->where('post_id', $post->id)->first()->delete();

        return back();

    }
}
