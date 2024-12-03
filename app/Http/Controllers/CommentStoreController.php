<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentStoreController extends Controller
{
    public function __invoke(Request $request){
        // here, using the post policy, we are checking if the user can create()->[this is an action we created in the postpolicy for a user to adhere to]
        // we are now saying can this request proceed to create an item Post::class
        // if email is not verified, action wont proceed, but we are commenting it out so we can do it better on the vue component
        $this->authorize('create', Post::class);
        // validation before sending to the database
        $this->validate($request, [
            'body' => 'required'
        ]);
        $request->user()->posts()->create($request->only('body'));
        // this returns with the normal back message
        return back()->with('message', [
            'body' => 'Post created',
            'type' => 'success'
        ]);
    }
}
