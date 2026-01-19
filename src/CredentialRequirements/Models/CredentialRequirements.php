<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;
use Marktic\Credentials\Bundle\Modules\Admin\Controllers\Behaviours\HasTenantControllerTrait;

/**
 * Class CredentialRequirements
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirements extends CredentialsRepository
{
    use HasTenantControllerTrait;

    public const TABLE = 'mkt_credential_requirements';

    public const CONTROLLER = 'mkt_credentials-requirements';

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
