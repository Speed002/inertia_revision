<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(Request $request, User $user){
        // This displays each users posts
        // loading the posts relationship on the user model
        $user->load('posts.user');
        return inertia()->render('Comments/user', [
            'user' => UserResource::make($user),
            'comments' => inertia()->lazy(function () use($user) {
                return PostResource::collection($user->posts);
            }),
        ]);
    }
}
