<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PostRepository;

class BlogController extends Controller
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
        return view('welcome', [
            'posts' => $this->posts->getAll(),
        ]);
    }

    /**
     * Return the post with the passed in date and slug.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getPostsAtDate(Request $request, $date)
    {
        return view('welcome', [
            'posts' => $this->posts->getPostsAtDate($date),
        ]);
    }

    /**
     * Return the post with the passed in date and slug.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getPost(Request $request, $date, $slug)
    {
        return view('welcome', [
            'posts' => $this->posts->getPost($date, $slug),
        ]);
    }
}