<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/** @var CredentialSubmission $item */
$item = $item ?? null;
$requirement = $item?->getCredentialRequirement();
$credential = $item?->getCredentialRecord();
$credentialFile = $credential ? $credential->getFile() : null;
$parent = $item?->getParentRecord();
$parentName = null;
if ($parent) {
    $parentName = method_exists($parent, 'getName') ? $parent->getName() : (method_exists($parent, 'getTitle') ? $parent->getTitle() : (string)($parent->id ?? ''));
}
?>
<tr>
    <td>
        <?php if ($parentName): ?>
            <a href="<?= $parent->getURL(); ?>" class="record-link" title="<?= htmlspecialchars($parentName); ?>">
                <?= $parentName; ?>
            </a>
        <?php else: ?>
            ---
        <?php endif; ?>
    </td>
    <td>
        <a href="<?= $item->getURL(); ?>" class="btn btn-xs btn-outline-primary record-link">
            View
        </a>
    </td>
    <td>
        <?= $item->getStatus()->getLabelHtml(); ?>
    </td>
    <td>
        <?php if ($requirement): ?>
            <?= $requirement->getName(); ?>
            <a href="<?= $requirement->getURL(); ?>" class="btn btn-xs btn-flat btn-info">?</a>
        <?php else: ?>
            ---
        <?php endif; ?>
    </td>
    <td>
        <?= $requirement ? BoolPropertyLabel::html($requirement->isMandatory()) : '---'; ?>
    </td>
    <td>
        <?= $requirement ? BoolPropertyLabel::html($requirement->requiresApproval()) : '---'; ?>
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