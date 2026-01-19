<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;

/**
 * Class CredentialRequirements
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirements extends CredentialsRepository
{
    public const TABLE = 'mkt_credential_requirements';

    public const CONTROLLER = 'mkt_credentials-requirements';

    /**
     * @inheritDoc
     */
    protected function generateTable(): string
    {
        return self::TABLE;
    }

    /**
     * @inheritDoc
     */
    protected function generateController(): string
    {
        return self::CONTROLLER;
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
