<?php

use Marktic\Credentials\CredentialSubmissions\Actions\GenerateFilePreviewHtml;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/** @var CredentialSubmission|null $item */
$item = $this->item ?? null;
?>

<?= GenerateFilePreviewHtml::for($item)->generate(); ?>
