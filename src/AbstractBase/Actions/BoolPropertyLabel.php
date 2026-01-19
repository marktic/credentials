<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Actions;

class BoolPropertyLabel
{
    public static function html($value): string
    {
        return '<span class="badge text-bg-' . ($value ? 'success' : 'secondary') . '">
            ' . translator()->trans($value ? 'yes' : 'no') . '
        </span>';
    }
}
