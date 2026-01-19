<?php

declare(strict_types=1);

namespace Marktic\Credentials\Utility;

use ByTIC\PackageBase\Utility\ModelFinder;
use Marktic\Credentials\CredentialTypes\Models\CredentialTypes;
use Marktic\Credentials\Credentials\Models\Credentials;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirements;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;
use Nip\Records\RecordManager;

/**
 * Class CredentialsModels.
 */
class CredentialsModels extends ModelFinder
{
    public const CREDENTIAL_TYPES = 'credential_types';
    public const CREDENTIALS = 'credentials';
    public const CREDENTIAL_REQUIREMENTS = 'credential_requirements';
    public const CREDENTIAL_SUBMISSIONS = 'credential_submissions';

    public static function types(): CredentialTypes|RecordManager
    {
        return static::getModels(self::CREDENTIAL_TYPES, CredentialTypes::class);
    }

    public static function typesClass(): string
    {
        return static::getConfigVar('models.' . self::CREDENTIAL_TYPES, CredentialTypes::class);
    }

    public static function credentials(): Credentials|RecordManager
    {
        return static::getModels(self::CREDENTIALS, Credentials::class);
    }

    public static function credentialsClass(): string
    {
        return static::getConfigVar('models.' . self::CREDENTIALS, Credentials::class);
    }

    public static function requirements(): CredentialRequirements|RecordManager
    {
        return static::getModels(self::CREDENTIAL_REQUIREMENTS, CredentialRequirements::class);
    }

    public static function requirementsClass(): string
    {
        return static::getConfigVar('models.' . self::CREDENTIAL_REQUIREMENTS, CredentialRequirements::class);
    }

    public static function submissions(): CredentialSubmissions|RecordManager
    {
        return static::getModels(self::CREDENTIAL_SUBMISSIONS, CredentialSubmissions::class);
    }

    public static function submissionsClass(): string
    {
        return static::getConfigVar('models.' . self::CREDENTIAL_SUBMISSIONS, CredentialSubmissions::class);
    }

    protected static function packageName(): string
    {
        return \Marktic\Credentials\CredentialsServiceProvider::NAME;
    }
}
