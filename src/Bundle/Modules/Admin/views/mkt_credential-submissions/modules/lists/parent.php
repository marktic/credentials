<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\Collections\Associated;

/** @var CredentialSubmission[]|Associated $items */
$items = $this->credentialsRequirements;
$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();
?>

<?php if ($items->count() === 0): ?>
    <?= $this->Messages()->info($submissionsRepository->getMessage('dnx')); ?>
    <?php return; ?>
<?php endif; ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th><?= $requirementsRepository->getLabel('title.singular') ?></th>
        <th><?= $requirementsRepository->getLabel('fields.is_mandatory'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.requires_approval'); ?></th>
        <th></th>
        <th><?= translator()->trans('status'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <?php $requirement = $item->getCredentialRequirement(); ?>
        <tr>
            <td>
                <a href="<?= $requirement->getURL() ?>" class="record-link">
                    <?= $requirement->getName(); ?>
                </a>
            </td>
            <td>
                <?= BoolPropertyLabel::html($requirement->isMandatory()); ?>
            </td>
            <td>
                <?= BoolPropertyLabel::html($requirement->requiresApproval()); ?>
            </td>
            <td>
                <a href="<?= $item->getURL() ?>" class="btn btn-sm btn-primary">
                    View
                </a>
            </td>
            <td>
                <?= $item->getStatusLabelHtml(); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
