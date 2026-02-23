<?php

use Marktic\Credentials\Utility\CredentialsModels;

$requirementsRepository = CredentialsModels::requirements();
?>
<thead>
<tr>
    <th></th>
    <th><?= translator()->trans('status'); ?></th>
    <th><?= translator()->trans('parent'); ?></th>
    <th><?= $requirementsRepository->getLabel('title.singular'); ?></th>
    <th><?= $requirementsRepository->getLabel('fields.is_mandatory'); ?></th>
    <th><?= $requirementsRepository->getLabel('fields.requires_approval'); ?></th>
    <th><?= translator()->trans('file'); ?></th>
</tr>
</thead>