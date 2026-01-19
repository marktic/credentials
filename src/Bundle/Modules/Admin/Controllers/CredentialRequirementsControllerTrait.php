<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Bundle\Admin\Forms\CredentialRequirements\DetailsForm;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
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

    /**
     * Get the form class for the model
     *
     * @param CredentialRequirement $model
     * @param string|null $action
     * @return string
     */
    protected function getModelFormClass($model, $action = null): string
    {
        return DetailsForm::class;
    }
}
