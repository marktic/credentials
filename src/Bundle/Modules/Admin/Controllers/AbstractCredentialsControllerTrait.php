<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\ViewUtility;
use Nip\Controllers\Response\ResponsePayload;
use Nip\View\View;

/**
 * Trait AbstractCredentialsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 *
 * @method ResponsePayload payload()
 */
trait AbstractCredentialsControllerTrait
{

    /**
     * Register view paths for the credentials package
     *
     * @param View $view
     * @return void
     */
    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        ViewUtility::registerAdminPaths($view);
    }
}
