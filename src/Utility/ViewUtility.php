<?php

declare(strict_types=1);

namespace Marktic\Credentials\Utility;

use Nip\View\View;

/**
 * Class ViewUtility
 * @package Marktic\Credentials\Utility
 */
class ViewUtility
{
    /**
     * Register view paths for the credentials package
     *
     * @param View $view
     * @param string $module
     * @return void
     */
    public static function registerViewPaths(View $view, string $module = 'admin'): void
    {
        $view->addPath(dirname(__DIR__, 2) . '/resources/views/' . $module);
    }
}
