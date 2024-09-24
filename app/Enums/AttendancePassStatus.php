<?php 

namespace App\Enums;

class AttendancePassStatus
{
    const ISSUED = 1;
    const DENIED = 0;

    public static function toArray(): array
    {
        return [
            self::ISSUED => 'Issued',
            self::DENIED => 'Denied',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::ISSUED:
                return 'Issued';
            case self::DENIED:
                return 'Denied';
            default:
                return '';
        }
    }
}