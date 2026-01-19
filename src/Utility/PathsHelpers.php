<?php

namespace Marktic\Credentials\Utility;

/**
 * Class PathsHelpers.
 */
class PathsHelpers
{
    public static function basePath(): string
    {
        return dirname(__DIR__, 2);
    }

    public static function config($path): string
    {
        return static::basePath() . '/config' . $path;
    }

    public static function modules($path): string
    {
        return static::basePath() . '/src/Bundle/Modules' . $path;
    }

    public static function viewsAdmin(): string
    {
        return static::modules( '/Admin/views');
    }
}
