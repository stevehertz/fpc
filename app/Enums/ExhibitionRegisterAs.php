<?php 

namespace App\Enums;

class ExhibitionRegisterAs
{
    const EXHIBITOR = 1;
    const DELEGATE = 2;

    public static function toArray(): array
    {
        return [
            self::EXHIBITOR => 'Exhibitor',
            self::DELEGATE => 'Delegate',
        ];
    }

    public static function getName($value): string
    {
        switch ($value) {
            case self::EXHIBITOR:
                return 'Exhibitor';
            case self::DELEGATE:
                return 'Delegate';
            default:
                return '';
        }
    }

}