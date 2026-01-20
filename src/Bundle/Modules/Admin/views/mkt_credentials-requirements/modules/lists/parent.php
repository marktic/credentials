<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\Collections\Associated;

/** @var CredentialRequirement[]|Associated $items */
$items = $this->credentialsRequirements;
$requirementsRepository = CredentialsModels::requirements();
?>

<?php if ($items->count() === 0): ?>
    <?= $this->Messages()->info($requirementsRepository->getMessage('dnx')); ?>
    <?php return; ?>
<?php endif; ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th><?= translator()->trans('name'); ?></th>
        <th><?= CredentialsModels::types()->getLabel('title.singular') ?></th>
        <th><?= translator()->trans('lead'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.is_active'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.is_mandatory'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.requires_approval'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td>
                <a href="<?= $item->getURL() ?>" class="record-link">
                    <?= $item->getName(); ?>
                </a>
            </td>
            <td>
                <?= $item->getCredentialType()->getLabel(); ?>
            </td>
            <td>
                <?= $item->getLead(); ?>
            </td>
            <td>
                <?= BoolPropertyLabel::html($item->isActive()); ?>
            </td>
            <td>
                <?= BoolPropertyLabel::html($item->isMandatory()); ?>
            </td>
            <td>
                <?= BoolPropertyLabel::html($item->requiresApproval()); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
