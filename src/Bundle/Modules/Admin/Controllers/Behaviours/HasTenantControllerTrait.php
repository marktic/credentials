<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers\Behaviours;

use Marktic\Credentials\AbstractBase\Models\Filters\TenantFilter;
use Marktic\Credentials\AbstractBase\Models\HasTenant\HasTenantRecord;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Filters\Sessions\Session;

trait HasTenantControllerTrait
{
    public function addNewModel()
    {
        /** @var HasTenantRecord $record */
        $record = parent::addNewModel();
        $record = $this->addNewModelFromTenant($record);
        return $record;
    }

    protected function addNewModelFromTenant($record)
    {
        $tenant = $this->getCredentialsTenantFromRequest();
        $record->populateFromTenant($tenant);
        return $record;
    }


    protected function getRequestFilters($session = null)
    {
        $request = $this->getRequest();
        $request->setAttribute(TenantFilter::NAME, $this->getCredentialsTenantFromRequest());
        /** @var Session $filter */
        return parent::getRequestFilters($session);
    }

    /**
     * @return mixed
     */
    protected function getCredentialsTenantFromRequest()
    {
        $tenantName = $this->getRequest()->get('tenant');
        return $this->checkForeignModelFromRequest($tenantName, ['tenant_id', 'id']);
    }

    protected function checkItemAccess($item)
    {
        $tenant = $item->getTenant();
        return $this->hasTenantAccess($tenant);
    }

    protected function hasTenantAccess($tenant)
    {
        return $tenant instanceof Record;
    }
}
