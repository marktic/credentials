<?php

namespace Marktic\Credentials\Bundle\Library\Records\Locator;

use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirements;
use Marktic\Credentials\Credentials\Models\Credentials;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;
use Marktic\Credentials\CredentialTypes\Models\CredentialTypes;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\RecordManager;

trait HasCredentialsModels
{
    /**
     */
    public static function credentialsTypes(): CredentialTypes|RecordManager
    {
        return CredentialsModels::types();
    }

    /**
     * @return Credentials|RecordManager
     */
    public static function credentialsCredentials(): Credentials|RecordManager
    {
        return CredentialsModels::credentials();
    }

    /**
     * @return CredentialRequirements|RecordManager
     */
    public static function credentialsRequirements(): CredentialRequirements|RecordManager
    {
        return CredentialsModels::requirements();
    }

    /**
     * @return CredentialSubmissions|RecordManager
     */
    public static function credentialsSubmissions(): CredentialSubmissions|RecordManager
    {
        return CredentialsModels::submissions();
    }
}