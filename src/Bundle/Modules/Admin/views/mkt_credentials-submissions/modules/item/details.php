<?php


use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\Utility\CredentialsModels;

$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();

/** @var CredentialSubmission $item */
$item = $item ?? $this->page;
$parentRecord = $item->getParentRecord();
$credentialRequirement = $item->getCredentialRequirement();
$credential = $item->getCredentialRecord();
$credentialFile = $credential->getFile();
?>
<table class="table table-striped">
    <tbody>
    <tr>
        <td>
            <?= $parentRecord->getManager()->getLabel('title.singular'); ?>
        </td>
        <td>
            <a href="<?= $parentRecord->getURL(); ?>" class="">
                <?= $parentRecord->getName(); ?>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <?= $requirementsRepository->getLabel('title.singular'); ?>
        </td>
        <td>
            <a href="<?= $credentialRequirement->getURL(); ?>" class="">
                <?= $credentialRequirement->getName(); ?>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('status'); ?>
        </td>
        <td>
            <?= $item->getStatus()->getLabelHTML(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('file'); ?>
        </td>
        <td>
            <?php if ($credentialFile) : ?>
                <a href="<?= $credentialFile->getURL(); ?>" class="" target="_blank">
                    View Credential
                </a>
            <?php else: ?>
            <?php endif; ?>
        </td>
    </tr>
    </tbody>
</table>