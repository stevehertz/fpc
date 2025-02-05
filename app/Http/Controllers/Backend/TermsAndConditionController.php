<?php

namespace App\Http\Controllers\Backend;

use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTermsAndConditionRequest;
use App\Http\Requests\UpdateTermsAndConditionRequest;
use App\Repositories\TermsAndConditionRepository;

class TermsAndConditionController extends Controller
{

    private $termsAndConditionRepository;
    public function __construct(TermsAndConditionRepository $termsAndConditionRepository)
    {
        $this->middleware('auth'); 
        $this->termsAndConditionRepository = $termsAndConditionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('backend.terms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTermsAndConditionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsAndCondition $termsAndCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TermsAndCondition $termsAndCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermsAndConditionRequest $request, TermsAndCondition $termsAndCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermsAndCondition $termsAndCondition)
    {
        //
    }
}
