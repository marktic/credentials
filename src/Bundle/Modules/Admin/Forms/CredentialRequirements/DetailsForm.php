<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Forms\CredentialRequirements;

use Marktic\Credentials\Bundle\Library\Form\FormModel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Class DetailsForm
 * @package Marktic\Credentials\Bundle\Admin\Forms\CredentialRequirements
 *
 * @method CredentialRequirement getModel()
 */
class DetailsForm extends FormModel
{
    public function initialize()
    {
        parent::initialize();

        $this->setAttrib('id', 'credential-requirement-form');

        $this->initializeName();
        $this->initializeLead();
        $this->initializeCredentialType();
        $this->initializeIsMandatory();
        $this->initializeRequiresApproval();
        $this->initializeIsActive();

        $this->addButton('save', translator()->trans('save'));
    }

    protected function initializeName()
    {
        $this->addInput('name', translator()->trans('name'), true);
    }

    protected function initializeLead()
    {
        $this->addTextSimpleEditor('lead', translator()->trans('lead'));
    }

    protected function initializeCredentialType()
    {
        $typesRepository = CredentialsModels::types();
        $items = $typesRepository->findAll();

        $this->addSelect('credential_type_id', $typesRepository->getLabel('title.singular'), true);
        $credentialTypeElement = $this->getElement('credential_type_id');
        foreach ($items as $item) {
            $credentialTypeElement->addOption($item->id, $item->getLabel());
        }
    }

    protected function initializeIsMandatory()
    {
        $this->initializeBooleanField('is_mandatory','is_mandatory');
    }

    protected function initializeRequiresApproval()
    {
        $this->initializeBooleanField('requires_approval', 'requires_approval');
    }

    protected function initializeIsActive()
    {
        $this->initializeBooleanField('is_active', 'is_active');
    }

    protected function initializeBooleanField(string $fieldName, string $labelKey): void
    {
        $this->addRadioGroup($fieldName, $this->getModelManager()->getLabel('fields.'.$labelKey));

        $element = $this->getElement($fieldName);
        $element->getRenderer()->setSeparator('');

        $element->addOption('yes', translator()->trans('yes'));
        $element->addOption('no', translator()->trans('no'));
    }

    protected function getDataFromModel()
    {
        parent::getDataFromModel();
        foreach (['is_mandatory', 'requires_approval', 'is_active'] as $field) {
            $value = $this->getModel()->{$field} ? 'yes' : 'no';
            $this->getElement($field)->setValue($value);
        }
    }

    public function saveToModel()
    {
        parent::saveToModel();
        foreach (['is_mandatory', 'requires_approval', 'is_active'] as $field) {
            $value = $this->getElement($field)->getValue() === 'yes' ? 1 : 0;
            $this->getModel()->{$field} = $value;
        }
    }
}
