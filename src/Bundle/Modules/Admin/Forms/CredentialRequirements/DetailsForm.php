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
        $this->addTextarea('lead', translator()->trans('lead'));
    }

    protected function initializeCredentialType()
    {
        $types = CredentialsModels::types();
        $items = $types->findAll();

        $this->addSelect('credential_type_id', translator()->trans('mkt_credentials-requirements.fields.credential_type'), true);
        $credentialTypeElement = $this->getElement('credential_type_id');
        foreach ($items as $item) {
            $credentialTypeElement->addOption($item->id, $item->getName());
        }
    }

    protected function initializeIsMandatory()
    {
        $this->initializeBooleanField('is_mandatory','is_active');
    }

    protected function initializeRequiresApproval()
    {
        $this->initializeBooleanField('requires_approval', 'is_active');
    }

    protected function initializeIsActive()
    {
        $this->initializeBooleanField('is_active', 'is_active');
    }

    protected function initializeBooleanField(string $fieldName, string $labelKey): void
    {
        $this->addBsRadioGroup($fieldName, $this->getModelManager()->getLabel($labelKey));
        $element = $this->getElement($fieldName);
        $element->addOption('yes', translator()->trans('yes'));
        $element->addOption('no', translator()->trans('no'));
    }

    protected function getDataFromModel()
    {
        parent::getDataFromModel();
        foreach ([] as $field) {
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
