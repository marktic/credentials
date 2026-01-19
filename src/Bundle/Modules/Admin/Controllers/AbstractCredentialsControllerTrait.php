<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use ByTIC\Controllers\Behaviors\CrudModels;
use ByTIC\Controllers\Behaviors\HasForms;
use ByTIC\Controllers\Behaviors\HasModels;
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
    use CrudModels;
    use HasForms;
    use HasModels;

    /**
     * Register view paths for the credentials package
     *
     * @param View $view
     * @return void
     */
    public function registerViewPaths(View $view): void
    {
        parent::registerViewPaths($view);

        ViewUtility::registerViewPaths($view, 'admin');
    }
}
