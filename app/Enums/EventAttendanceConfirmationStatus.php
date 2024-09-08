<?php 

namespace App\Enums;

class EventAttendanceConfirmationStatus
{
    const CONFIRMED = 1;
    const PENDING = 0;
    const CANCELLED = 2;

    public static function toArray(): array
    {
        return [
            self::CONFIRMED => 'Confirmed',
            self::PENDING => 'Pending',
            self::CANCELLED => 'Cancelled',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::CONFIRMED:
                return 'Confirmed';
            case self::PENDING:
                return 'Pending';
            case self::CANCELLED:
                return 'Cancelled';
            default:
                return '';
        }
    }
}