<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;

/**
 * Class Credentials
 * @package Marktic\Credentials\Credentials\Models
 */
class Credentials extends CredentialsRepository
{
    public const TABLE = 'mkt_credential_credentials';

    public const CONTROLLER = 'mkt_credentials-credentials';

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
