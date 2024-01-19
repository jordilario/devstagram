<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function store(User $user) {

/*         Follower::create([
            'user_id'=>Auth::user()->id,
            'follower_id' => $user->id
        ]); */

        $user->followers()->attach( Auth::user()->id );

        return back();
    }

    public function destroy(User $user) {
        $user->followers()->detach( Auth::user()->id );

        return back();
    }
}
