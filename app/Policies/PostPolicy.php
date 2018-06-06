<?php

namespace Blogs\Policies;

use Blogs\User;
use Blogs\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(User $user, Post $post)
    {
        return $user->id == $post->user_id; //validacion simple, si user id == a post user_id return es =  a true
    }
}
