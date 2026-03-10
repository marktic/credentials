<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;

$card = Card::make()
    ->withView($this)
    ->withTitle(translator()->trans('file'))
    ->withIcon(Icons::list_ul())
    ->withViewContent('/mkt_credentials-submissions/modules/item/validate-actions');
?>
<?= $card ?>
