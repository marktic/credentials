<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialSubmissionsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialSubmissionsControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function generateModelName(): string
    {
        return CredentialsModels::submissionsClass();
    }
}
