<?php

namespace App\Policies;

use App\User;
use App\Posts;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function view(User $user, Posts $post)
    {
        return true; //$user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function update(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function delete(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function restore(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can permanently delete the posts.
     *
     * @param  \App\User  $user
     * @param  \App\Posts  $posts
     * @return mixed
     */
    public function forceDelete(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }
}
