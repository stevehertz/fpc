<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'event_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'organization',
        'position',
        'user_type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function event()  
    {
        return $this->belongsTo(Event::class);    
    }

    public function payment()  
    {
        return $this->hasMany(Payment::class, 'attendance_id');    
    }
}