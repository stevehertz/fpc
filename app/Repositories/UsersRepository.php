<?php 

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersRepository
{

    public function getAllUsers()  
    {
        return User::where('id', '!=', Auth::user()->id)->latest()->get();
    }

    public function storeUser() 
    {
        
    }

    public function showUser() 
    {
        
    }

}