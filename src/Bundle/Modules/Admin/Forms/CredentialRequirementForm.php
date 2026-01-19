<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Forms;

use Marktic\Credentials\Utility\CredentialsModels;

class CredentialRequirementForm extends AbstractCredentialsForm
{
    protected function getModelClass(): string
    {
        return CredentialsModels::requirementsClass();
    }

    protected function buildFormFields(): void
    {
        $this->addTextField('name', 'Name', true);
        $this->addTextareaField('description', 'Description');
        $this->addSelectField('type', 'Type', $this->getRequirementTypes());
        $this->addTextField('value', 'Value');
        $this->addCheckboxField('is_active', 'Active', true);
    }

    private function getRequirementTypes(): array
    {
        return [
            'minimum_age' => 'Minimum Age',
            'license' => 'License Required',
            'certification' => 'Certification',
            'experience' => 'Experience Level',
        ];
    }
}
