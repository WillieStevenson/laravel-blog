<?php

namespace App\Repositories;

use App\User;
use App\Post;

use DB;

class PostRepository
{
    /**
     * Get all of the posts for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Post::where('user_id', $user->id)
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->orderBy('created_at', 'asc')
                    ->select('posts.*', 'users.name as author')
                    ->get();
    }

    /**
     * Get post at id.
     *
     * @param  INT    $id    id of post
     * @return Collection
     */
    public function find($id)
    {
        return DB::table('posts')
                    ->where('id', $id)
                    ->select('posts.*')
                    ->get();
    }

    /**
     * Update post at id
     *
     * @param  Request $request, INT $id
     * @return Collection
     */
    public function update($request, $id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->update(['title' => $request->title, 'body' => $request->body, 'tags' => $request->tags]);
    }

    /**
     * Get all posts.
     *
     * @param  none
     * @return Collection
     */
    public function getAll()
    {
        return DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->orderBy('updated_at', 'desc')
                    ->select('posts.*', 'users.name as author')
                    ->get();
    }

    /**
     * Get all posts $dateand $lug.
     *
     * @param  $date and $slug
     * @return Collection
     */
    public function getPost($date, $slug)
    {
        return DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->where('posts.updated_at', '>=', $date)
                    ->where('posts.updated_at', '<', date('Y-m-d',strtotime($date . "+1 days")))
                    ->where('slug', $slug)
                    ->select('posts.*', 'users.name as author')
                    ->get();
    }

    /**
     * Get posts at date.
     *
     * @param  none
     * @return Collection
     */
    public function getPostsAtDate($date)
    {
        return DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->where('posts.updated_at', '>=', $date)
                    ->where('posts.updated_at', '<', date('Y-m-d',strtotime($date . "+1 days")))
                    ->orderBy('updated_at', 'desc')
                    ->select('posts.*', 'users.name as author')
                    ->get();
    }
}
