<?php

namespace App\Enums;

class EventPaymentStatus
{
    const PAID = 2;
    const PENDING = 0;
    const UNPAID = 1;

    public static function toArray(): array
    {
        return [
            self::PAID => 'Fully Paid',
            self::PENDING => 'Partially Paid',
            self::UNPAID => 'Unpaid',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::PAID:
                return 'Fully Paid';
            case self::PENDING:
                return 'Partially Paid';
            case self::UNPAID:
                return 'Unpaid';
            default:
                return '';
        }
    }
}
