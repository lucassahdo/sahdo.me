<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use Illuminate\Http\Request;
use Flash;

use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;

class WebsiteController extends Controller 
{
    private $apiRepo;

    /**
     * WebsiteController constructor.
     */
    public function __construct()
    {
        $this->apiRepo = new ApiRepository();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home() 
    {
        $posts = $this->apiRepo->getPosts();

        $data = [
            'page' => 'home',
            'posts' => $posts
        ];

        return view('website.content.home', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blog()
    {
        $posts = $this->apiRepo->getPosts();

        $data = [
            'page' => 'blog',
            'posts' => $posts
        ];

        return view('website.content.blog', $data);
    }

    /**
     *
     */
    public function post($id)
    {
        $post = $this->apiRepo->getSinglePost($id);

        $data = [
            'page' => 'blog',
            'post' => isset($post->id) ? $post : null
        ];

        return view('website.content.post', $data);
    }

    /**
     * 
     */
    public function notfound() 
    {        
        return view('website.errors.404');
    }

    /**
     *
     */
    public function building()
    {
        return view('website.building');
    }

    /**
     * 
     */
    public function dashboard() 
    {
        return view('pages.dashboard', [
            'page' => 'analytics_dashboard',
            'page_title' => 'Dashboard'
        ]);
    }   
}