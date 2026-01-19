<?php

namespace Marktic\Credentials\AbstractBase\Models\HasTenant;

/**
 * Trait HasTenantRepository
 * @package Marktic\Credentials\AbstractBase\Models\HasTenant
 */
trait HasTenantRepository
{
    public function initRelations()
    {
        parent::initRelations();
        $this->initRelationsSequence();
    }

    protected function initRelationsSequence(): void
    {
        $this->initRelationsSequenceTenant();
    }

    protected function initRelationsSequenceTenant(): void
    {
        $this->morphTo('Tenant', ['morphPrefix' => 'tenant', 'morphTypeField' => 'tenant']);
    }
}
