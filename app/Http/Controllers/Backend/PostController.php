<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $postsRepository;
    public function __construct(PostsRepository $postsRepository)
    {
        $this->middleware('auth');
        $this->postsRepository = $postsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->postsRepository->getAllPosts();
        return view('backend.posts.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.posts.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        if ($request->hasFile('featured_image')) {
            $featureImage = $request->file('featured_image');
        } else {
            $featureImage = null;
        }

        $posts = $this->postsRepository->storePost($request->all(), $featureImage);

        if ($posts) {
            return response()->json([
                'status' => true,
                'message' => 'Post created successfully.'
            ], 200);
        }
    }

    /**
     * Method to upload images via Summernote
     * */
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/img/posts');
            return response()->json(asset(str_replace('public', 'storage', $path)));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $this->postsRepository->showPost($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = $this->postsRepository->showPost($id);
        return view('backend.posts.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        if ($request->hasFile('featured_image')) {
            $featureImage = $request->file('featured_image');
        } else {
            $featureImage = $post->featured_image;
        }

        $posts = $this->postsRepository->updatePost($request->all(), $post, $featureImage);

        if ($posts) {
            return response()->json([
                'status' => true,
                'message' => 'Post updated successfully.'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        if($this->postsRepository->destroyPost($post))
        {
            return response()->json([
                'status' => true,
                'message' => 'Successfully removed post'
            ]);
        }
    }
}
