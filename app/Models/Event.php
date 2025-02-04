<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'venue',
        'theme',
        'start_date',
        'end_date',
        'priority',
        'image',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'event_id');
    }

    public function cancelAttendance()
    {
        return $this->hasMany(CancelAttendance::class);
    }

}
