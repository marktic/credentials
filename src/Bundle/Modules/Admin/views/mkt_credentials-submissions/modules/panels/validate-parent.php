<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\Utility\CredentialsModels;

$credentialParent = $credentialParent ?? $this->credentialParent;

$card = Card::make()
    ->withView($this)
    ->withIcon(Icons::list_ul())
//    ->themeSuccess()
    ->wrapBody(false);

if ($credentialParent) {
    $parentRepository = $credentialParent->getManager();
    $card
        ->withTitle($parentRepository->getLabel('title.singular'))
        ->withViewContent('/' . $parentRepository->getController() . '/modules/item/details', ['item' => $credentialParent]);
} else {
    $card->withTitle(translator()->trans('No parent'));
    $card->withContent(translator()->trans('No parent found'));
}
?>
<?= $card ?>
