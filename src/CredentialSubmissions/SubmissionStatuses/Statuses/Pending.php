<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses;

/**
 * Class Pending
 */
class Pending extends AbstractStatus
{
    public const NAME = 'pending';

    public function getColorClass()
    {
        return 'info';
    }

}
