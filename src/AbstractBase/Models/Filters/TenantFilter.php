<?php

namespace Marktic\Credentials\AbstractBase\Models\Filters;

use Nip\Database\Query\Select as SelectQuery;
use Nip\Records\Filters\AbstractFilter;
use Nip\Records\Record;

/**
 * Class TenantFilter
 * @package Marktic\Credentials\AbstractBase\Models\Filters
 */
class TenantFilter extends AbstractFilter
{
    public const NAME = 'tenant';

    public function initName(): void
    {
        $this->setName(self::NAME);
    }

    /**
     * @param SelectQuery $query
     */
    public function filterQuery($query)
    {
        $tenant = $this->getTenantRecord();

        $query->where("tenant = ?", $tenant->getManager()->getMorphName());
        $query->where('tenant_id = ?', $tenant->id);
    }

    /**
     * @return Record
     */
    protected function getTenantRecord()
    {
        $record = $this->getValue();

        return $record;
    }

    public function isValidRequestValue($value): bool
    {
        return $value instanceof Record;
    }

    public function cleanRequestValue($value): Record
    {
        return $value;
    }
}
