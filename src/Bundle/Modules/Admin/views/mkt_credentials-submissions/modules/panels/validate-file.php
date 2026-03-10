<?php

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/** @var CredentialSubmission|null $item */
$item = $this->item ?? null;

$card = Card::make()
    ->withView($this)
    ->withTitle(translator()->trans('file'))
    ->withIcon(Icons::list_ul())
    ->wrapBody(false)
    ->withViewContent('/mkt_credentials-submissions/modules/item/file-preview');

$credential = $item->getCredentialRecord();
$file = $credential->getFile();
if ($file) {
    $url = $file->getFullUrl();
    $card->addHeaderTool(ButtonAction::make()
        ->setUrl($url)
        ->addHtmlClass('btn-xs')
        ->setHtmlAttribute('target', '_blank')
        ->setLabel('View'));
}
?>
<?= $card ?>
