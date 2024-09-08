<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AnalyticsRepository;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $analyticsRepository;
    public function __construct(AnalyticsRepository $analyticsRepository)
    {
        $this->middleware('auth');
        $this->analyticsRepository = $analyticsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->analyticsRepository->getTrafficData();
        return view('backend.dashboard', [
            'data' => $data,
        ]);
    }
}
