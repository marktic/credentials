<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRecord;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRecord;
use Marktic\Credentials\AbstractBase\Models\HasTenant\HasTenantRecord;
use Marktic\Credentials\CredentialTypes\ModelsRelated\HasCredentialType\HasCredentialTypeRecordTrait;

/**
 * Class CredentialRequirement
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirement extends CredentialsRecord
{
    use HasTenantRecord;
    use HasParentRecord;
    use HasCredentialTypeRecordTrait;

    public $name = null;
    public $lead = null;

    public $is_mandatory = null;
    public $requires_approval = null;
    public $is_active = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLead(): ?string
    {
        return $this->lead;
    }

    public function isMandatory(): bool
    {
        return $this->is_mandatory == '1';
    }

    public function requiresApproval(): bool
    {
        return $this->requires_approval == '1';
    }

    public function isActive(): bool
    {
        return $this->is_active == '1';
    }
}
