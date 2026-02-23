<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\Collections\Associated;

/** @var CredentialSubmission[]|Associated $items */
$items = $this->credentialsSubmissions;
$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();
?>

<?php if ($items->count() === 0): ?>
    <?= $this->Messages()->info($submissionsRepository->getMessage('dnx')); ?>
    <?php return; ?>
<?php endif; ?>

<?php
// Collect available statuses for dropdown (from controller or repository)
$statuses = $this->statuses ?? [];
if (empty($statuses) && method_exists($submissionsRepository, 'getStatuses')) {
    $statuses = $submissionsRepository->getStatuses();
}
?>

<table class="table table-striped">
    <thead>
    <tr>
        <th></th>
        <th><?= translator()->trans('status'); ?></th>
        <th><?= $requirementsRepository->getLabel('title.singular') ?></th>
        <th><?= $requirementsRepository->getLabel('fields.requires_approval'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.is_mandatory'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <?php
        $requirement = $item->getCredentialRequirement();
        $credential = $item->getCredentialRecord();
        $credentialFile = $credential->getFile();
        ?>
        <tr>

            <td>
                <a href="<?= $item->getURL() ?>" class="btn btn-xs btn-outline-primary record-link">
                    View
                </a>
            </td>
            <td>
                <?= $item->getStatus()->getLabelHTML(); ?>
                <?php if (!empty($statuses)) : ?>
                    <div class="dropdown d-inline-block ms-1">
                        <a class="btn dropdown-toggle btn-xs btn-primary" data-bs-toggle="dropdown" href="#">
                            <i class="fas fa-edit"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($statuses as $status) { ?>
                                <?php if ($status->getName() != $item->getStatus()->getName()) { ?>
                                    <li>
                                        <a href="<?= $item->getChangeStatusURL(['status' => $status->getName()]); ?>"
                                           class="dropdown-item">
                                            <?= $status->getLabel(); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </td>
            <td>
                <?= $requirement->getName(); ?>
                <a href="<?= $requirement->getURL() ?>" class="btn btn-xs btn-flat btn-info">
                    ?
                </a>
            </td>
            <td>
                <?= BoolPropertyLabel::html($requirement->isMandatory()); ?>
            </td>
            <td>
                <?= BoolPropertyLabel::html($requirement->requiresApproval()); ?>
            </td>
            <td>
                <?php if ($credentialFile) : ?>
                    <a href="<?= $credentialFile->getURL(); ?>" class="btn btn-xs btn-flat btn-info" target="_blank">
                        View FILE
                    </a>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
