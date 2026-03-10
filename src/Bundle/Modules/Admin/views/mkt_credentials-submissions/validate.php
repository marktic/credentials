<?php

use Marktic\Credentials\CredentialSubmissions\Actions\GenerateFilePreviewHtml;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;

$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();

/** @var CredentialSubmission|null $item */
$item = $this->item ?? null;

/** @var array $skip */
$skip = $this->skip ?? [];
?>

<?= $this->Flash()->render($this->controller); ?>

<?php if (!$item): ?>
    <div class="alert alert-success">
        <?= translator()->trans('mkt_credentials-submissions.validate.no_pending'); ?>
    </div>
<?php else: ?>
    <?php
    $credentialRequirement = $item->getCredentialRequirement();

    $validateBaseUrl = $submissionsRepository->compileURL('validate');

    $skipIds = array_values(array_unique(array_merge($skip, [$item->id])));
    $skipUrl = $validateBaseUrl . '?' . http_build_query(['skip' => $skipIds]);

    $approveUrl = $validateBaseUrl . '?' . http_build_query(
        array_filter(['action' => 'approve', 'item_id' => $item->id, 'skip' => $skip ?: null])
    );
    $rejectUrl = $validateBaseUrl . '?' . http_build_query(
        array_filter(['action' => 'reject', 'item_id' => $item->id, 'skip' => $skip ?: null])
    );
    ?>

    <div class="d-grid gap-3">
        <div class="row">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-header">
                        <?= $requirementsRepository->getLabel('title.singular') ?>
                    </div>
                    <div class="card-body">
                        <h5><?= htmlspecialchars((string) $credentialRequirement->getName()); ?></h5>
                        <?php if ($credentialRequirement->getLead()): ?>
                            <p class="text-muted"><?= htmlspecialchars((string) $credentialRequirement->getLead()); ?></p>
                        <?php endif; ?>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <strong><?= $requirementsRepository->getLabel('fields.is_mandatory') ?>:</strong>
                                <?= $credentialRequirement->isMandatory() ? translator()->trans('yes') : translator()->trans('no') ?>
                            </li>
                            <li>
                                <strong><?= $requirementsRepository->getLabel('fields.requires_approval') ?>:</strong>
                                <?= $credentialRequirement->requiresApproval() ? translator()->trans('yes') : translator()->trans('no') ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <?= translator()->trans('file'); ?>
                    </div>
                    <div class="card-body">
                        <?= GenerateFilePreviewHtml::for($item)->generate(); ?>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="<?= htmlspecialchars($approveUrl); ?>"
                       class="btn btn-success"
                       onclick="return confirm(<?= json_encode(translator()->trans('mkt_credentials-submissions.validate.confirm_approve')); ?>)">
                        <?= translator()->trans('mkt_credentials-submissions.validate.approve'); ?>
                    </a>
                    <a href="<?= htmlspecialchars($rejectUrl); ?>"
                       class="btn btn-danger"
                       onclick="return confirm(<?= json_encode(translator()->trans('mkt_credentials-submissions.validate.confirm_reject')); ?>)">
                        <?= translator()->trans('mkt_credentials-submissions.validate.reject'); ?>
                    </a>
                    <a href="<?= htmlspecialchars($skipUrl); ?>"
                       class="btn btn-secondary">
                        <?= translator()->trans('mkt_credentials-submissions.validate.skip'); ?>
                    </a>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
