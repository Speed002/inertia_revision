<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class CommentsIndexController extends Controller
{
    public function __invoke()
    {
        return inertia()->render('Comments/index', [
            // 'comments' => Post::latest()->get(), //without Resource //with eager loading we loaded the relationship before getting the posts
            // so in another call for displaying the comments, you have to make sure that the relationship in the post model that relates with user is called, in order for you to recieve the comment.
            'comments' => PostResource::collection(Post::with('user')->latest()->get()),
            // 'now' => now(),this is content that is skipped to return
            'can' => [
                'create_post' => auth()->user()->can('create', Post::class)
                ]
        ]);
    }
}
