<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Bundle\Modules\Admin\Controllers\Behaviours\HasTenantControllerTrait;
use Marktic\Credentials\Bundle\Modules\Admin\Forms\CredentialRequirements\DetailsForm;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialRequirementsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsRequirementsControllerTrait
{
    use AbstractCredentialsControllerTrait;
    use HasTenantControllerTrait;

    protected function afterActionUrlDefault($type, $item = null)
    {
        $parent = $item->getParentRecord();
        return $parent->getURL();
    }

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
