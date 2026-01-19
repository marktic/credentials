<?php

namespace Marktic\Credentials\AbstractBase\Models\HasTenant;

use Nip\Records\Record;

/**
 * Trait HasTenantRecord
 * @package Marktic\Credentials\AbstractBase\Models\HasTenant
 *
 * @method Record getTenant
 */
trait HasTenantRecord
{
    public string|int|null $tenant_id;
    public string|null $tenant_type;

    /**
     * @param Record $record
     */
    public function populateFromTenant($record)
    {
        $this->tenant_id = $record->id;
        $this->tenant_type = $record->getManager()->getMorphName();
        $this->getRelation('Tenant')->setResults($record);
    }
}
