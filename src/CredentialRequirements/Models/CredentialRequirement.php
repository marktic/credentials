<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Models;

use Nip\Records\Record;

/**
 * Class CredentialRequirement
 * @package Marktic\Credentials\CredentialRequirements\Models
 */
class CredentialRequirement extends Record
{
    use CredentialRequirementTrait;
}
