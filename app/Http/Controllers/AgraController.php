<?php

namespace App\Http\Controllers;

use App\Exports\AgraExport;
use App\Models\Agra;
use App\Http\Requests\StoreAgraRequest;
use App\Http\Requests\UpdateAgraRequest;
use App\Imports\AgraFileImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AgraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Agra::latest()->get();
        return view('backend.agra.index', [
            'data' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Excel::import(new AgraFileImport(), request()->file('file'));
        return redirect()->route('agra');
    }

    public function export()  
    {
        return Excel::download(new AgraExport, 'agra_export.xlsx');        
    }

    /**
     * Display the specified resource.
     */
    public function show(Agra $agra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agra $agra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgraRequest $request, Agra $agra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agra $agra)
    {
        //
    }
}
