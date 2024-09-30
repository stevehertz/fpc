<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization',
        'email',
        'phone'
    ];
}
