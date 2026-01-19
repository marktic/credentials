<?php

use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirements;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;
use Marktic\Credentials\CredentialTypes\Models\CredentialTypes;
use Marktic\Credentials\Credentials\Models\Credentials;
use Marktic\Credentials\Utility\CredentialsModels;

return [
    'models' => [
        CredentialsModels::CREDENTIAL_TYPES => CredentialTypes::class,
        CredentialsModels::CREDENTIALS => Credentials::class,
        CredentialsModels::CREDENTIAL_REQUIREMENTS => CredentialRequirements::class,
        CredentialsModels::CREDENTIAL_SUBMISSIONS => CredentialSubmissions::class,
    ],
    'tables' => [
        CredentialsModels::CREDENTIAL_TYPES => CredentialTypes::TABLE,
        CredentialsModels::CREDENTIALS => Credentials::TABLE,
        CredentialsModels::CREDENTIAL_REQUIREMENTS => CredentialRequirements::TABLE,
        CredentialsModels::CREDENTIAL_SUBMISSIONS => CredentialSubmissions::TABLE,
    ],
    'database' => [
        'connection' => 'default',
        'migrations' => true,
    ],
];
