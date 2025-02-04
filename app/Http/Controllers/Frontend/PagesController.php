<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\EventRepositories;
use App\Repositories\PostsRepository;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    private $postsRepository, $sliderRepository, $eventRepositories;

    public function __construct(PostsRepository $postsRepository, SliderRepository $sliderRepository, EventRepositories $eventRepositories)
    {
        $this->postsRepository = $postsRepository;
        $this->sliderRepository = $sliderRepository;
        $this->eventRepositories = $eventRepositories;
    }

    public function index()
    {
        $sliders = $this->sliderRepository->getSliderFront();
        $criticalEventData = $this->eventRepositories->showUpcomingCriticalEvent();
        return view('frontend.index', [
            'sliders' => $sliders,
            'criticalEvent' => $criticalEventData
        ]);
    }

    public function viewSlider($slug)
    {
        $data = $this->sliderRepository->showSliderBySlug($slug);
        $relatedPosts = Post::limit(7)->get();
        return view('frontend.pages.viewSlider', [
            'data' => $data,
            'relatedPosts' => $relatedPosts
        ]);
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
        $criticalEventData = $this->eventRepositories->showUpcomingCriticalEvent();
        return view('frontend.pages.events', [
            'criticalEvent' => $criticalEventData
        ]);
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

    public function terms_and_conditions()
    {
        return view('frontend.pages.terms-and-conditions');
    }

    public function who_we_are()
    {
        return view('frontend.pages.who-we-are');
    }
}
