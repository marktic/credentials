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
    public const NAMESPACE = 'MktCredentials';


    public static function registerAdminPaths(View $view)
    {
        $path = PathsHelpers::viewsAdmin();
        $view->addPath($path, self::NAMESPACE);
        $view->addPath($path);
    }
}
