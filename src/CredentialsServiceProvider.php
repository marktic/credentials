<?php

declare(strict_types=1);

namespace Marktic\Credentials;

use ByTIC\PackageBase\BaseBootableServiceProvider;
use Marktic\Credentials\Utility\PackageConfig;

/**
 * Class CredentialsServiceProvider.
 */
class CredentialsServiceProvider extends BaseBootableServiceProvider
{
    public const NAME = 'mkt_credentials';

    public function boot(): void
    {
        parent::boot();

//        CredentialsModels::types();
//        CredentialsModels::credentials();
//        CredentialsModels::requirements();
//        CredentialsModels::submissions();
    }

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return \dirname(__DIR__) . '/database/migrations/';
        }

        return null;
    }

    protected function translationsPath(): ?string
    {
        return \dirname(__DIR__) . '/resources/lang/';
    }

    public function provides(): array
    {
        return array_merge(
            [
            ],
            parent::provides()
        );
    }
}
