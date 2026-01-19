<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Nip\Records\RecordManager;

/**
 * Class CredentialRequirements
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirements extends RecordManager
{
    use CredentialRequirementsTrait;

    public const TABLE = 'mkt_credential_requirements';

    public const CONTROLLER = 'credentials-requirements';

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
