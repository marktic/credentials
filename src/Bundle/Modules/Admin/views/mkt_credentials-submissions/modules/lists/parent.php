<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\Collections\Associated;

/** @var CredentialSubmission[]|Associated $items */
$items = $this->credentialsSubmissions;
/** @var CredentialRequirement[]|iterable $requirements */
$requirements = $this->credentialsRequirements ?? null;

$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();

$statuses = $submissionsRepository->getStatuses();

// If requirements are available, display all of them (with or without a submission).
// Otherwise fall back to displaying only the existing submissions.
if ($requirements !== null && $requirements->count() > 0):
?>

<table class="table table-striped">
    <thead>
    <tr>
        <th></th>
        <th><?= translator()->trans('status'); ?></th>
        <th><?= $requirementsRepository->getLabel('title.singular') ?></th>
        <th><?= $requirementsRepository->getLabel('fields.requires_approval'); ?></th>
        <th><?= $requirementsRepository->getLabel('fields.is_mandatory'); ?></th>
        <th><?= translator()->trans('file'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($requirements as $requirement):
        /** @var CredentialSubmission|null $submission */
        $submission = $items->has($requirement->id) ? $items->get($requirement->id) : null;
        $credential = $submission ? $submission->getCredentialRecord() : null;
        $credentialFile = $credential ? $credential->getFile() : null;
        $baseAddUrl = $this->credentialsSubmissionsAdd ?? '';
        $addUrl = $baseAddUrl
            ? $baseAddUrl . '&credential_requirement_id=' . urlencode((string)$requirement->id)
            : '';
    ?>
        <tr>
            <td>
                <?php if ($submission && $submission->isSubmitted()): ?>
                    <a href="<?= $submission->getURL() ?>" class="btn btn-xs btn-outline-primary record-link">
                        <?= translator()->trans('view'); ?>
                    </a>
                <?php else: ?>
                    <a href="<?= $addUrl ?>" class="btn btn-xs btn-outline-success record-link">
                        <?= translator()->trans('add'); ?>
                    </a>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($submission && $submission->isSubmitted()): ?>
                    <?= $submission->getStatus()->getLabelHTML(); ?>
                    <?php if (!empty($statuses)) : ?>
                        <div class="dropdown d-inline-block ms-1">
                            <a class="btn dropdown-toggle btn-xs btn-primary" data-bs-toggle="dropdown" href="#">
                                <i class="fas fa-edit"></i>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($statuses as $status) { ?>
                                    <?php if ($status->getName() != $submission->getStatus()->getName()) { ?>
                                        <li>
                                            <a href="<?= $submission->getChangeStatusURL(['status' => $status->getName()]); ?>"
                                               class="dropdown-item">
                                                <?= $status->getLabel(); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="badge bg-secondary"><?= translator()->trans('not_submitted'); ?></span>
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
                        <?= translator()->trans('view_file'); ?>
                    </a>
                <?php else: ?>
                    ---
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php elseif ($items->count() === 0): ?>
    <?= $this->Messages()->info($submissionsRepository->getMessage('dnx')); ?>
    <?php return; ?>
<?php else: ?>

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
                    <?= translator()->trans('view'); ?>
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
                        <?= translator()->trans('view_file'); ?>
                    </a>
                <?php else: ?>
                    ---
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
