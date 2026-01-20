<?php

?>

<?= $this->Flash()->render($this->controller); ?>

<div class="d-grid gap-l">
    <div class="row">
        <div class="col-md-6">
            <?= $this->load('/' . $this->controller . '/modules/panels/item-details'); ?>
        </div>
    </div>
</div>
