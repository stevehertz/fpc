<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SliderRepository
{
    public function getSliders()
    {
        return Slider::latest()->get();
    }

    function getSliderFront()
    {
        return Slider::limit(7)->get();
    }

    public function storeSlide(array $attributes, ?UploadedFile $image = null)
    {
        $slider = Slider::create([
            'title' => data_get($attributes, 'title'),
            'image' => 'img/sliders/noimage.png',
            'description' => data_get($attributes, 'description'),
            'slug' =>  Str::slug(data_get($attributes, 'title')),
            'posted_at' => data_get($attributes, 'posted_at'),
            'created_by' => data_get($attributes, 'user_id'),
            'updated_by' => data_get($attributes, 'user_id'),
        ]);

        // upload featured image
        if ($image) {
            $path = $image->store('img/sliders', 'public');
            $slider->update(['image' => $path]);
        }

        return $slider;
    }

    public function showSlider($id)
    {
        return Slider::findOrFail($id);
    }

    public function showSliderBySlug($slug)
    {
        return Slider::where('slug', $slug)->first();
    }

    public function updateSlider(array $attributes, Slider $slider, ?UploadedFile $image = null)
    {
        $slider->update([
            'title' => data_get($attributes, 'title'),
            'image' => $slider->image,
            'description' => data_get($attributes, 'description'),
            'slug' =>  Str::slug(data_get($attributes, 'title')),
            'updated_by' => data_get($attributes, 'user_id'),
        ]);

        // upload featured image
        if ($image) {
            $path = $image->store('img/sliders', 'public');
            $slider->update(['image' => $path]);
        }

        return $slider;
    }


    public function destroySlider(Slider $slider)
    {
        // Delete the image from storage
        if ($slider->image) {
            if ($slider->image != 'img/sliders/noimage.png') {
                Storage::disk('public')->delete($slider->image);
            }
        }

        // Delete the slider record from the database
        $slider->delete();

        return true;
    }
}
