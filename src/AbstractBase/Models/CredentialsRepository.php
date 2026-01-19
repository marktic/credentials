<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Models;

use Marktic\Credentials\AbstractBase\Models\Traits\BaseRepositoryTrait;
use Nip\Records\RecordManager;

class CredentialsRepository extends RecordManager
{
    use BaseRepositoryTrait;

}