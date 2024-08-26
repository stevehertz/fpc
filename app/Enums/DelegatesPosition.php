<?php 

namespace App\Enums;

class DelegatesPosition
{
    const MANAGER = 1;
    const DIRECTOR = 2;

    public static function toArray(): array
    {
        return [
            self::MANAGER => 'Manager',
            self::DIRECTOR => 'Director',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::MANAGER:
                return 'Manager';
            case self::DIRECTOR:
                return 'Director';
            default:
                return '';
        }
    }
}