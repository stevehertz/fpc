<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $fillable = [
        'event_id',
        'attendance_id',
        'phone',
        'amount',
        'paid',
        'payment_status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function event()  
    {
        return $this->belongsTo(Event::class, 'event_id');    
    }

    public function attendance()  
    {
        return $this->belongsTo(Attendance::class, 'attendance_id');    
    }

    public static function findPaymentsByPaid($phone)  
    {
        return self::where('phone', $phone)->first();    
    }
}
