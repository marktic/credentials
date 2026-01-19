<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialTypesControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialTypesControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function generateModelName(): string
    {
        return CredentialsModels::typesClass();
    }
}
