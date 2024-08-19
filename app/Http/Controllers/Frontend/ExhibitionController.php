<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    //
    public function sign_up()  
    {
        return view('frontend.exhibition.sign-up');
    }
}
