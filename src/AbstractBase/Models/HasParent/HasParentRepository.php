<?php

namespace Marktic\Credentials\AbstractBase\Models\HasParent;

/**
 * Trait HasParentRepository
 * @package Marktic\Credentials\AbstractBase\Models\HasParent
 */
trait HasParentRepository
{
    public function initRelations()
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialsParentRecord();
    }

    protected function initRelationsCredentialsParentRecord(): void
    {
        $this->morphTo('ParentRecord', ['morphPrefix' => 'parent']);
    }
}
