<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    private $postsRepository;
    public function __construct(PostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;   
    }

    public function index() 
    {
        return view('frontend.index');    
    }

    public function about()  
    {
        return view('frontend.pages.about');    
    }

    public function services()  
    {
        return view('frontend.pages.services');    
    }
    
    public function blog()  
    {
        $posts = Post::latest()->get();
        return view('frontend.pages.blog', [
            'data' => $posts
        ]);
    }

    public function blogDetails($slug)  
    {
        $post = $this->postsRepository->showPostBySlug($slug);
        return view('frontend.pages.blog-details', [
            'data' => $post
        ]);
    }

    public function events()  {
        return view('frontend.pages.events');
    }

    public function contact()  
    {
        return view('frontend.pages.contact');
    }
}
