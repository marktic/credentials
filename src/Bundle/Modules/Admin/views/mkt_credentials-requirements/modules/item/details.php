<?php
/** @var CredentialRequirement $item */

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;

$requirementsRepository = CredentialsModels::requirements();

$item = $item ?? $this->credentialRequirement;
?>
<table class="table table-striped">
    <tbody>
    <tr>
        <td>
            <?= translator()->trans('name'); ?>
        </td>
        <td>
            <?= $item->getName(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('lead'); ?>
        </td>
        <td>
            <?= $item->getLead(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $requirementsRepository->getLabel('fields.is_mandatory'); ?>
        </td>
        <td>
            <?= BoolPropertyLabel::html($item->isMandatory()); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $requirementsRepository->getLabel('fields.requires_approval'); ?>
        </td>
        <td>
            <?= BoolPropertyLabel::html($item->requiresApproval()); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $requirementsRepository->getLabel('fields.is_active'); ?>
        </td>
        <td>
            <?= BoolPropertyLabel::html($item->isActive()); ?>
        </td>
    </tr>
    </tbody>
</table>