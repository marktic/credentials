<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function generateModelName(): string
    {
        return CredentialsModels::credentialsClass();
    }
}
