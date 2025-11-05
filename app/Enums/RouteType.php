<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RouteType: string implements HasLabel
{
    case Landing     = 'landing';
    case About       = 'about';
    case Error       = 'error';
    case Contact     = 'contact';             
    case Search      = 'search';             

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
            self::Landing        => 'Home',
            self::About          => 'About',            
            self::Error          => 'Error',
            self::Contact        => 'Contact',
            self::Search         => 'Search',
        };
    }
}