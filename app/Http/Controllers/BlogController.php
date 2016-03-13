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
        $all_posts = $this->posts->getAll();

        foreach ($all_posts as $single_post) {
            $shortened_post = substr($single_post->body, 0, strpos($single_post->body,"</p>")) . "</p>";
            $read_more_link = '<p><a href="/blog/' . date('Y-m-d', strtotime($single_post->created_at)) . '/' . $single_post->slug . '">Read more</a></p>'; 

            $single_post->body = $shortened_post . $read_more_link;
        }

        return view('welcome', [
            'posts' => $all_posts,
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
        $all_posts = $this->posts->getAll();

        foreach ($all_posts as $single_post) {
            $shortened_post = substr($single_post->body, 0, strpos($single_post->body,"</p>")) . "</p>";
            $read_more_link = '<p><a href="/blog/' . date('Y-m-d', strtotime($single_post->created_at)) . '/' . $single_post->slug . '">Read more</a></p>'; 

            $single_post->body = $shortened_post . $read_more_link;
        }
        
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
