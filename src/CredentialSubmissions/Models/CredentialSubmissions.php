<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;

/**
 * Class CredentialSubmissions
 * @package Marktic\Credentials\CredentialSubmissions\Models
 */
class CredentialSubmissions extends CredentialsRepository
{
    public const TABLE = 'mkt_credential_submissions';

    public const CONTROLLER = 'mkt_credentials-submissions';

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
