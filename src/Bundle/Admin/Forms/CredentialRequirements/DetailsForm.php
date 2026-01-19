<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Admin\Forms\CredentialRequirements;

use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Class DetailsForm
 * @package Marktic\Credentials\Bundle\Admin\Forms\CredentialRequirements
 *
 * @method CredentialRequirement getModel()
 */
class DetailsForm extends AbstractForm
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

        $this->addButton('save', translator()->translate('general.buttons.save'));
    }

    protected function initializeName()
    {
        $this->addInput('name', translator()->translate('mkt_credentials-requirements.fields.name'), true);
    }

    protected function initializeLead()
    {
        $this->addTextarea('lead', translator()->translate('mkt_credentials-requirements.fields.lead'));
    }

    protected function initializeCredentialType()
    {
        $types = CredentialsModels::typesClass();
        $items = $types->findAll();

        $this->addSelect('credential_type_id', translator()->translate('mkt_credentials-requirements.fields.credential_type'), true);
        foreach ($items as $item) {
            $this->getElement('credential_type_id')->addOption($item->id, $item->getName());
        }
    }

    protected function initializeIsMandatory()
    {
        $this->addCheckbox('is_mandatory', translator()->translate('mkt_credentials-requirements.fields.is_mandatory'));
    }

    protected function initializeRequiresApproval()
    {
        $this->addCheckbox('requires_approval', translator()->translate('mkt_credentials-requirements.fields.requires_approval'));
    }

    protected function initializeIsActive()
    {
        $this->addCheckbox('is_active', translator()->translate('mkt_credentials-requirements.fields.is_active'));
    }
}
