<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class PostsRepository
{

    public  function getAllPosts()
    {
        return Post::with(['user'])->latest()->get();
    }

    public  function storePost(array $attributes, ?UploadedFile $featureImage = null)
    {
        $user = User::findOrFail(data_get($attributes, 'user_id'));
        if ($user) {
            $post = $user->post()->create([
                'title' => data_get($attributes, 'title'),
                'featured_image' => 'img/posts/noimage.png',
                'content' => data_get($attributes, 'content'),
                'slug' =>  Str::slug(data_get($attributes, 'title')),
            ]);

            // upload featured image
            if ($featureImage) {
                $path = $featureImage->store('img/posts', 'public');
                $post->update(['featured_image' => $path]);
            }

            return $post;
        }
    }

    public function showPost($id)
    {
        return Post::with(['user'])->findOrFail($id);
    }

    public function showPostBySlug($slug)
    {
        return Post::with(['user'])->where('slug', $slug)->firstOrFail();
    }

    public function updatePost(array $attributes, Post $post, ?UploadedFile $featureImage = null)
    {

        $post->update([
            'title' => data_get($attributes, 'title'),
            'featured_image' => 'img/posts/noimage.png',
            'content' => data_get($attributes, 'content'),
            'slug' =>  Str::slug(data_get($attributes, 'title')),
        ]);

        // upload featured image
        if ($featureImage) {
            $path = $featureImage->store('img/posts', 'public');
            $post->update(['featured_image' => $path]);
        }

        return $post;
    }

    public function destroyPost(Post $post)
    {
        if ($post->delete()) {
            return true;
        }

        return false;
    }
}
