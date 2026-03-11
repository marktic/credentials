<?php

use Marktic\Credentials\CredentialSubmissions\Actions\GenerateFilePreviewHtml;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;


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
    $credentialParent = $item->getParentRecord();
    ?>

    <div class="d-grid gap-3">
        <div class="row">
            <div class="col-md-8">
                <?= $this->load('/mkt_credentials-submissions/modules/panels/validate-file'); ?>
            </div>
            <div class="col-md-4">
                <?= $this->load('/mkt_credentials-submissions/modules/panels/validate-requirement', ['credentialRequirement' => $credentialRequirement]); ?>
                <?= $this->load('/mkt_credentials-submissions/modules/panels/validate-actions'); ?>
                <?= $this->load('/mkt_credentials-submissions/modules/panels/validate-parent', ['credentialParent' => $credentialParent]); ?>
        </div>
    </div>
<?php endif; ?>
