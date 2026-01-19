<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Nip\Records\RecordManager;

/**
 * Class CredentialSubmissions
 * @package Marktic\Credentials\CredentialSubmissions\Models
 */
class CredentialSubmissions extends RecordManager
{
    use CredentialSubmissionsTrait;

    public const TABLE = 'mkt_credential_submissions';

    public const CONTROLLER = 'credentials-submissions';

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
