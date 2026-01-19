<?php

use Marktic\Credentials\AbstractBase\Actions\BoolPropertyLabel;
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
        <?= BoolPropertyLabel::html($item->isActive()); ?>
    </td>
    <td>
    </td>
</tr>