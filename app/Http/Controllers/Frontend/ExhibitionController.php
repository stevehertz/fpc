<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\EventRepositories;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    //
    private $eventRepositories;
    public function __construct(EventRepositories $eventRepositories)
    {
        $this->eventRepositories = $eventRepositories;
    }

    public function sign_up($slug)  
    {
        $data = $this->eventRepositories->showEventBySlug($slug);
        return view('frontend.exhibition.sign-up', [
            'data' => $data
        ]);
    }
}
