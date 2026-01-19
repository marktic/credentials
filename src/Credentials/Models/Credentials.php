<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Models;

use Nip\Records\RecordManager;

/**
 * Class Credentials
 * @package Marktic\Credentials\Credentials\Models
 */
class Credentials extends RecordManager
{
    use CredentialsTrait;

    public const TABLE = 'mkt_credential_credentials';

    public const CONTROLLER = 'credentials-credentials';

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
