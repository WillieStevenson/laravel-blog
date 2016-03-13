<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * The post repository instance.
     *
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new controller instance.
     *
     * @param  PostRepository  $posts
     * @return void
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');

        $this->posts = $posts;
    }

    /**
     * Display a list of all of the user's post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('posts.index', [
            'posts' => $this->posts->forUser($request->user()),
            'single_post' => NULL,
        ]);
    }

    /**
     * Display all posts.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getAllPosts(Request $request)
    {
        return view('welcome', [
            'posts' => $this->posts->getAll(),
        ]); 
    }


    /**
     * Create a new post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required|unique:posts|max:255',
            'body' => 'required',
            'tags' => 'required',
            'release_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'tags' => $request->tags,
            'release_at' => $request->release_at,
            'slug' => str_slug($request->title, "-"),
        ]);

        return redirect('/blog/posts');
    }

    /**
     * Update an existing post.
     *
     * @param Request  $request, post id $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'bail|required|max:255',
            'body' => 'required',
            'tags' => 'required',
            'release_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $request->slug = str_slug($request->title, "-");

        $this->posts->update($request, $id);

        return redirect('/blog/posts');
    }

    /**
     * Pull the post from the database
     *
     * @param Request  $request, post id $id
     * @return Collection
     */
    public function edit(Request $request, $id)
    {
        $arr = $this->posts->find($id);
        $arr = $arr[0];

        return view('posts.index', [
            'posts' => $this->posts->forUser($request->user()),
            'single_post' => $arr,
        ]);
    }

    /**
     * Destroy the given post.
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return redirect('/blog/posts');
    }
}
