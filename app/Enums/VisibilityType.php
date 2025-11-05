<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VisibilityType: string implements HasLabel
{
    case Private = 'Private';
    case Public = 'Public';
    case Opengraph = 'Opengraph';

    /**
     * Get an array of all enum values.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the human-readable label for the enum case.
     *
     * @return string
     */
    public function getLabel(): ?string
    {    
        return match ($this) {
            self::Private => 'Private',
            self::Public => 'Public',
            self::Opengraph => 'Open Graph',
        };
    }
}