<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialTypes\Models;

use Nip\Records\RecordManager;

/**
 * Class CredentialTypes
 * @package Marktic\Credentials\CredentialTypes\Models
 */
class CredentialTypes extends RecordManager
{
    use CredentialTypesTrait;

    public const TABLE = 'mkt_credential_types';

    public const CONTROLLER = 'credentials-types';

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
