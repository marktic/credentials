<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRepository;
use Marktic\Credentials\AbstractBase\Models\HasTenant\HasTenantRepository;

/**
 * Class CredentialRequirements
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirements extends CredentialsRepository
{
    use HasTenantRepository, HasParentRepository {
        HasTenantRepository::initRelations insteadof HasParentRepository;
    }

    public const TABLE = 'mkt_credential_requirements';

    public const CONTROLLER = 'mkt_credentials-requirements';

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialsTenant();
        $this->initRelationsCredentialsParentRecord();
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
