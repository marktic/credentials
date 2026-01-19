<?php

?>

<?= $this->Flash()->render($this->controller); ?>

<div class="d-grid gap-l">
    <div class="row">
        <div class="col-md-6">
            <?= $this->load('/mkt_sequence-ranges/modules/panels/item-details'); ?>
        </div>
        <div class="col-md-6">
            <?= $this->load('/mkt_sequence-ranges/modules/panels/item-links'); ?>
        </div>
    </div>
</div>
