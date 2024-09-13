<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'attendance_id', 
        'reasons',
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

    public function attendance()  
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');    
    }
}
