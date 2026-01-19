<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Models\Traits;

use ByTIC\Records\Behaviors\HasForms\HasFormsRecordsTrait;
use Marktic\Credentials\AbstractBase\Models\Timestampable\TimestampableManagerTrait;
use Nip\I18n\Translatable\HasTranslations;
use Nip\Records\Filters\Records\HasFiltersRecordsTrait;
use Nip\Records\Traits\Relations\HasRelationsRecordsTrait;

trait BaseRepositoryTrait
{
    use HasFormsRecordsTrait;
    use HasFiltersRecordsTrait;
    use HasRelationsRecordsTrait;
    use TimestampableManagerTrait;
    use HasDatabaseConnectionTrait;
    use HasTranslations;

    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsSequence();
    }

    protected function initRelationsSequence()
    {
    }

    protected function generateController(): string
    {
        if (\defined('static::CONTROLLER')) {
            return static::CONTROLLER;
        }

        return $this->getTable();
    }

    protected function getTranslateRoot()
    {
        return $this->getController();
    }
}