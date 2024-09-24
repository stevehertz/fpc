<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    private $usersRepository;
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware('auth');
        $this->usersRepository = $usersRepository;
    }

    public function index()  
    {
        $data = $this->usersRepository->getAllUsers();
        return view('backend.users.index', [
            'data' => $data
        ]);   
    }
}
