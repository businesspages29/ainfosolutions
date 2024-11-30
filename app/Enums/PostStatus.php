<?php

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    /**
     * Get options for the dropdown.
     */
    public static function options(): array
    {
        return [
            self::Draft->value => 'Draft',
            self::Published->value => 'Published',
        ];
    }
}
