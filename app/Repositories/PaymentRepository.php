<?php 

namespace App\Repositories;

use App\Enums\EventPaymentStatus;
use App\Models\Attendance;

class PaymentRepository
{
    public function storePayment(array $attributes, Attendance $attendance)  
    {
        if($attendance)
        {
            $payment = $attendance->payment()->create([
                'event_id' => $attendance->event->id,
                'transaction_code' => data_get($attributes, 'transaction_code'),
                'amount' => data_get($attributes, 'amount'),
                'paid' => data_get($attributes, 'paid'),
                'payment_status' => EventPaymentStatus::PENDING,
            ]);

            return $payment;
        }

        return false;
    }
}