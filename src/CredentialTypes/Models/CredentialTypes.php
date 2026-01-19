<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialTypes\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;

/**
 * Class CredentialTypes
 * @package Marktic\Credentials\CredentialTypes\Models
 */
class CredentialTypes extends CredentialsRepository
{
    public const TABLE = 'mkt_credential_types';

    public const CONTROLLER = 'mkt_credentials-types';

    public function findActive()
    {
        return $this->findByField('is_active', 1);
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
