<?php 

namespace App\Repositories;

use App\Enums\EventPaymentStatus;
use App\Models\Attendance;
use App\Models\Payment;

class PaymentRepository
{
    public function getAllPayments()  
    {
        return Payment::latest()->get(); 
    }

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

    public function confirmAndUpdatePayments(array $attributes, Attendance $attendance)  
    {
        $transactionCode = data_get($attributes, 'transaction_code');
        $payment = Payment::where('transaction_code', $transactionCode)->first();
        if($payment)
        {
            $paid_amount = data_get($attributes, 'paid');
            $amount = $payment->amount;
            if ($paid_amount < $amount) {
                // Calculate balance if paid amount is less than the total amount
                $balance = $amount - $paid_amount;
                $paymentStatus = EventPaymentStatus::PENDING;
            } elseif ($paid_amount > $amount) {
                // Calculate change if paid amount is more than the total amount
                $change = $paid_amount - $amount;
                $paymentStatus = EventPaymentStatus::PAID;
            } else 
            {
                $balance = $amount - $paid_amount;
                $paymentStatus = EventPaymentStatus::PAID;
            }

            $payment->update([
                'paid' => $paid_amount,
                'payment_status' => $paymentStatus
            ]);

            return $payment;
        }
        return false;

        // if($payment->transaction_code == $transactionCode)
        // {

        // }else
        // {

        // }
    }
}