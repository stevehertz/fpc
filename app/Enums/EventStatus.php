<?php 

namespace App\Enums;

class EventStatus
{
    const UPCOMING = 1;
    const ONGOING = 2;
    const ENDED = 3;

    public static function toArray(): array
    {
        return [
            self::UPCOMING => 'Upcoming',
            self::ONGOING => 'On going',
            self::ENDED => 'Ended',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::UPCOMING:
                return 'Upcoming';
            case self::ONGOING:
                return 'On going';
            case self::ENDED:
                return 'Ended';
            default:
                return '';
        }
    }
}