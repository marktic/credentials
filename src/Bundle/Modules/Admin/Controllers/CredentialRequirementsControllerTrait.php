<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialRequirementsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialRequirementsControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function generateModelName(): string
    {
        return CredentialsModels::requirementsClass();
    }
}
