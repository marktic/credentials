<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\Utility\CredentialsModels;

$requirementsRepository = CredentialsModels::requirements();
$credentialRequirement = $credentialRequirement ?? $this->credentialRequirement;

$card = Card::make()
    ->withView($this)
    ->withTitle($requirementsRepository->getLabel('title.singular'))
    ->withIcon(Icons::list_ul())
//    ->themeSuccess()
    ->wrapBody(false)
    ->withViewContent('/' . $requirementsRepository->getController() . '/modules/item/details', ['item' => $credentialRequirement]);
?>
<?= $card ?>
