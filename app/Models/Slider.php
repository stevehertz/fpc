<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function createdBy()  
    {
        return $this->belongsTo(User::class, 'created_by'); 
    }
}
