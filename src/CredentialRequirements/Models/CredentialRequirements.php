<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;
use Marktic\Credentials\AbstractBase\Models\HasTenant\HasTenantRepository;

/**
 * Class CredentialRequirements
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirements extends CredentialsRepository
{
    use HasTenantRepository;

    public const TABLE = 'mkt_credential_requirements';

    public const CONTROLLER = 'mkt_credentials-requirements';

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialsTenant();
        $this->initRelationsCredentialsParent();
    }

    protected function initRelationsCredentialsParent(): void
    {
        $this->morphTo('ParentRecord', ['morphPrefix' => 'parent', 'morphTypeField' => 'parent']);
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
