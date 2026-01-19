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
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialsTenant();
    }

    protected function initRelationsCredentialsTenant(): void
    {
        $this->morphTo('Tenant', ['morphPrefix' => 'tenant', 'morphTypeField' => 'tenant']);
    }
}
