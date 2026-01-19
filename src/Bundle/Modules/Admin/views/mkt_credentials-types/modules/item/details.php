<?php


use Marktic\Credentials\CredentialTypes\Models\CredentialType;
use Marktic\Credentials\Utility\CredentialsModels;

$repository = CredentialsModels::types();
/** @var CredentialType $item */
$item = $item ?? $this->page;
?>
<table class="table table-striped">
    <tbody>
    <tr>
        <td>
            <?= translator()->trans('name'); ?>
        </td>
        <td>
            <?= $item->getName(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('label'); ?>
        </td>
        <td>
            <?= $item->getName(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('active'); ?>
        </td>
        <td>
            <span class="badge badge-<?= $item->isActive() ? 'success' : 'secondary' ?>">
                <?= $item->isActive() ? 'Active' : 'Inactive' ?>
            </span>
        </td>
    </tr>
    <tr>
        <td>
            <?= translator()->trans('lead'); ?>
        </td>
        <td>
            <?= $item->getLead(); ?>
        </td>
    </tr>

    <tr>
        <td>
            <?= translator()->trans('description'); ?>
        </td>
        <td>
            <?= $item->description; ?>
        </td>
    </tr>
    </tbody>
</table>