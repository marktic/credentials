<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Update;

use Marktic\Credentials\CredentialSubmissions\Events\RejectedSubmission;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Rejected;

/**
 * Domain action that rejects a credential submission.
 * Dispatches a RejectedSubmission event upon completion.
 */
class RejectSubmission extends AbstractUpdateSubmissionStatusAction
{
    protected function getNewStatus(): string
    {
        return Rejected::NAME;
    }

    protected function getEventClass(): string
    {
        return RejectedSubmission::class;
    }
}
