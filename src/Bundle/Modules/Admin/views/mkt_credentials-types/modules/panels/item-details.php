<?php

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\CredentialTypes\Models\CredentialType;
use Marktic\Credentials\Utility\CredentialsModels;

/** @var CredentialType $item */
$item = $item ?? $this->item;

$pagesRepository = CredentialsModels::types();
$card = Card::make()
    ->withView($this)
    ->withTitle($pagesRepository->getLabel('title.singular'))
    ->withIcon(Icons::list_ul())
    ->addHeaderTool(
        ButtonAction::make()
            ->setUrl(
                $item->compileURL('edit')
            )
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('edit'))
    )
//    ->themeSuccess()
    ->wrapBody(false)
    ->withViewContent('/' . $pagesRepository->getController() . '/modules/item/details', ['item' => $this->item]);
?>
<?= $card ?>