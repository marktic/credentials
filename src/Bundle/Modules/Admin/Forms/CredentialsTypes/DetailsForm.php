<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Forms\CredentialsTypes;

use Marktic\Credentials\Bundle\Library\Form\FormModel;
use Marktic\Credentials\Utility\CredentialsModels;

class DetailsForm extends FormModel
{
    public function initialize()
    {
        parent::initialize();

        $this->initializeName();
        $this->initializeLabel();
        $this->initializeDescription();
        $this->initializeActive();

        $this->addButton('save', translator()->trans('submit'));
    }

    protected function initializeName()
    {
        $this->addInput('name', translator()->trans('name'), true);
    }

    protected function initializeLabel()
    {
        $this->addInput('label', translator()->trans('label'), true);
    }

    protected function initializeDescription()
    {
        $this->addTexteditor('description', translator()->trans('description'), true);
    }
    protected function initializeActive()
    {
        $this->addRadioGroup('active', translator()->trans('active'), false);
        $activeElement = $this->getElement('active');
        $activeElement->addOption('1', translator()->trans('yes'));
        $activeElement->addOption('0', translator()->trans('no'));
    }
}
