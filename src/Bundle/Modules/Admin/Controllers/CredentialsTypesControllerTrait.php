<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Bundle\Modules\Admin\Forms\CredentialsTypes\DetailsForm;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialTypesControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsTypesControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function getModelFormClass($model, $action = null): string
    {
        return DetailsForm::class;
    }

    protected function generateModelName(): string
    {
        return CredentialsModels::typesClass();
    }
}
