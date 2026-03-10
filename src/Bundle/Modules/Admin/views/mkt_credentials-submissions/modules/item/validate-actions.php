<?php

use Marktic\Credentials\CredentialSubmissions\Actions\GenerateFilePreviewHtml;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;

/** @var CredentialSubmission|null $item */
$item = $this->item ?? null;

$submissionsRepository = CredentialsModels::submissions();
$validateBaseUrl = $submissionsRepository->compileURL('validate');

$skip = $this->skip ?? [];
$skipIds = array_values(array_unique(array_merge($skip, [$item->id])));
$skipUrl = $validateBaseUrl . '?' . http_build_query(['skip' => $skipIds]);

$approveUrl = $validateBaseUrl . '?' . http_build_query(
        array_filter(['action' => 'approve', 'item_id' => $item->id, 'skip' => $skip ?: null])
    );
$rejectUrl = $validateBaseUrl . '?' . http_build_query(
        array_filter(['action' => 'reject', 'item_id' => $item->id, 'skip' => $skip ?: null])
    );

?>

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
