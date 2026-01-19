<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Models\Traits;

use Marktic\Credentials\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

/**
 * Trait HasDatabaseConnectionTrait.
 */
trait HasDatabaseConnectionTrait
{
    /**
     * @return Connection
     */
    protected function newDbConnection()
    {
        return \app('db')->connection(PackageConfig::databaseConnection());
    }
}
