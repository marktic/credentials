<?php

use ByTIC\AdminBase\Screen\Actions\Dto\ButtonAction;
use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\Utility\CredentialsModels;

/** @var string $credentialsRequirementsAdd */
$pagesRepository = CredentialsModels::requirements();

$card = Card::make()
    ->withView($this)
    ->withTitle($pagesRepository->getLabel('title.singular'))
    ->withIcon(Icons::list_ul())
    ->addHeaderTool(
        ButtonAction::make()
            ->setUrl($this->credentialsRequirementsAdd)
            ->addHtmlClass('btn-xs')
            ->setLabel(translator()->trans('edit'))
    )
//    ->themeSuccess()
    ->wrapBody(false)
    ->withViewContent('/' . $pagesRepository->getController() . '/modules/item/details', ['item' => $this->item]);
?>
<?= $card ?>