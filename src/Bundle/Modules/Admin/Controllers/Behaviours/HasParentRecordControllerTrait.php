<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers\Behaviours;

use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRecord;

trait HasParentRecordControllerTrait
{

    /**
     * @param HasParentRecord $record
     * @return mixed
     */
    protected function addNewModelFromParent($record)
    {
        $tenant = $this->getCredentialsParentFromRequest();
        $record->populateFromParentRecord($tenant);
        return $record;
    }

    /**
     * @return mixed
     */
    protected function getCredentialsParentFromRequest()
    {
        $tenantName = $this->getRequest()->get('parent_type');
        return $this->checkForeignModelFromRequest($tenantName, ['parent_id', 'id']);
    }
}
