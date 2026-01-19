<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Models;

use Nip\Records\Record;

/**
 * Class Credential
 * @package Marktic\Credentials\Credentials\Models
 */
class Credential extends Record
{
    use CredentialTrait;
}
