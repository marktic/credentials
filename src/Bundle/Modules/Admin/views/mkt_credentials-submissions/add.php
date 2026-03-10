<?php

use ByTIC\AdminBase\Widgets\Cards\Card;
use ByTIC\Icons\Icons;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\AbstractModels\Record;

$submissionsRepository = CredentialsModels::submissions();
$requirementsRepository = CredentialsModels::requirements();

/** @var Record $parent */
$parent = $this->parent ?? null;
/** @var CredentialRequirement|null $requirement */
$requirement = $this->requirement ?? null;
/** @var iterable $requirements */
$requirements = $this->requirements ?? [];

$formAction = $submissionsRepository->compileURL('add', [
    'parent_type' => $parent ? $parent->getManager()->getMorphName() : '',
    'parent_id' => $parent ? $parent->id : '',
]);
?>

<?= $this->Flash()->render($this->controller); ?>

<div class="d-grid gap-l">
    <div class="row">
        <div class="col-md-8">
            <?php
//                ->withTitle($submissionsRepository->getLabel('title.singular'))
//                ->withIcon(Icons::plus());
            ?>
            <form action="<?= $formAction ?>"
                  method="POST"
                  enctype="multipart/form-data"
                  class="form-horizontal row-mb-3">

                <input type="hidden" name="parent_type"
                       value="<?= htmlspecialchars($parent ? $parent->getManager()->getMorphName() : '') ?>">
                <input type="hidden" name="parent_id"
                       value="<?= htmlspecialchars((string)($parent ? $parent->id : '')) ?>">

                <?php if (!empty($this->error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($this->error) ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="credential_requirement_id" class="form-label">
                        <?= $requirementsRepository->getLabel('title.singular') ?> *
                    </label>
                    <?php if ($requirement): ?>
                        <input type="hidden" name="credential_requirement_id"
                               value="<?= htmlspecialchars((string)$requirement->id) ?>">
                        <p class="form-control-plaintext">
                            <?= htmlspecialchars($requirement->getName()) ?>
                        </p>
                    <?php else: ?>
                        <select name="credential_requirement_id" id="credential_requirement_id"
                                class="form-select" required>
                            <option value="">-- <?= translator()->trans('select') ?> --</option>
                            <?php foreach ($requirements as $req): ?>
                                <option value="<?= htmlspecialchars((string)$req->id) ?>">
                                    <?= htmlspecialchars($req->getName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="credential_file" class="form-label">
                        <?= translator()->trans('file') ?>
                    </label>
                    <input type="file"
                           name="credential_file"
                           id="credential_file"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <?= translator()->trans('save') ?>
                    </button>
                    <?php if ($parent): ?>
                        <a href="<?= $parent->getURL() ?>" class="btn btn-secondary ms-2">
                            <?= translator()->trans('cancel') ?>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
