<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'user_id',
        'title', 
        'featured_image',
        'content', 
        'slug'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user()  
    {
        return $this->belongsTo(User::class);    
    }
}
