<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    // in the post policy, we can see if the user CAN do certain actions like create, delete, update or modify
    public function create(User $user){
        return $user->hasVerifiedEmail();
    }
}
