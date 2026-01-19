<?php

use Marktic\Credentials\CredentialTypes\Models\CredentialType;

/** @var CredentialType $item */
$item = $item ?? null;
?>
<tr>
    <td>
        <a class="record-link" href="<?= $item->getURL(); ?>" title="">
            <?= $item->getName(); ?>
        </a>
    </td>
    <td>
        <?= $item->getLabel(); ?>
    </td>
    <td>
        <span class="badge text-bg-<?= $item->isActive() ? 'success' : 'secondary' ?>">
            <?= $item->isActive() ? 'Active' : 'Inactive' ?>
        </span>
    </td>
    <td>
    </td>
</tr>