<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LegalRoute: string implements HasLabel
{
    case Privacy     = 'privacy';
    case Terms       = 'terms';
    case Cookies     = 'cookies';             
    case Disclaimer  = 'disclaimer';             

    /**
     * Get all enum values.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all enum labels.
     *
     * @return array
     */
    public static function labels(): array
    {
        return array_map(
            fn (self $case) => $case->getLabel(),
            self::cases()
        );
    }

    /**
     * Get the human-readable label for the enum case.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Privacy        => 'Privacy',
            self::Terms          => 'Terms',
            self::Cookies        => 'Cookies',
            self::Disclaimer     => 'Disclaimer',
        };
    }
}