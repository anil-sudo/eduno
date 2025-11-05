<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;


enum MediaType: string implements HasLabel
{
    case Video = 'Video';
    case Image = 'Image';

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
    public function getLabel(): string
    {
        return match ($this) {
            self::Video => 'Video',
            self::Image => 'Image',
        };
    }
}