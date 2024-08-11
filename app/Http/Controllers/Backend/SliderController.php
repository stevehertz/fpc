<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{

    private $sliderRepository;
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->middleware('auth');   
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->sliderRepository->getSliders();
        return view('backend.sliders.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.sliders.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        //
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        } else {
            $image = null;
        }

        $slider = $this->sliderRepository->storeSlide($request->all(), $image);

        if ($slider) {
            return response()->json([
                'status' => true,
                'message' => 'Slider created successfully.'
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
            $path = $file->store('public/img/sliders');
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
            'data' => $this->sliderRepository->showSlider($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = $this->sliderRepository->showSlider($id);
        return view('backend.sliders.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        //
        if ($request->hasFile('image')) {
            $image = $request->file('image');
        } else {
            $image = null;
        }

        $slider = $this->sliderRepository->updateSlider($request->all(), $slider, $image);

        if ($slider) {
            return response()->json([
                'status' => true,
                'message' => 'Slider updated successfully.'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
        if($this->sliderRepository->destroySlider($slider))
        {
            return response()->json([
                'status' => true,
                'message' => 'Successfully deleted slider'
            ]);
        }
    }
}
