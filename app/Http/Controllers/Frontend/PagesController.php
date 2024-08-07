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
        $posts = Post::latest()->paginate(6);
        return view('frontend.pages.blog', [
            'data' => $posts
        ]);
    }

    public function blogDetails($slug)  
    {
        $post = $this->postsRepository->showPostBySlug($slug);
        $relatedPosts = Post::where('slug', '!=', $post->slug)->limit(6)->get();
        return view('frontend.pages.blog-details', [
            'data' => $post,
            'relatedPosts' => $relatedPosts
        ]);
    }

    public function events()  {
        return view('frontend.pages.events');
    }

    public function faqs()  
    {
        return view('frontend.pages.faqs');    
    }

    public function contact()  
    {
        return view('frontend.pages.contact');
    }

    public function becomeMember()  
    {
        $filePath = public_path('membership/FPC-Kenya-Registration-Form-2020.docx');

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, "FPC-Kenya-Registration-Form-2020.docx", [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ]);

    }
}
