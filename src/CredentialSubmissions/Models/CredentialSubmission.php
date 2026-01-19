<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Nip\Records\Record;

/**
 * Class CredentialSubmission
 * @package Marktic\Credentials\CredentialSubmissions\Models
 */
class CredentialSubmission extends Record
{
    use CredentialSubmissionTrait;
}
