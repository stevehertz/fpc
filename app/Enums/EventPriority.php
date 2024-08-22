<?php

namespace App\Enums;

class EventPriority
{
    const CRITICAL = 1;
    const HIGH = 2;
    const MODERATE = 3;

    public static function toArray(): array
    {
        return [
            self::CRITICAL => 'Critical',
            self::HIGH => 'High',
            self::MODERATE => 'Moderate',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::CRITICAL:
                return 'Critical';
            case self::HIGH:
                return 'High';
            case self::MODERATE:
                return 'Moderate';
            default:
                return '';
        }
    }
}
