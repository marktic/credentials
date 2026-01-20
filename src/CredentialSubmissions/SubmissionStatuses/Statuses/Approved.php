<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses;

/**
 * Class Validated
 */
class Approved extends AbstractStatus
{
    public const NAME = 'approved';

    public function getColorClass()
    {
        return 'success';
    }
}
