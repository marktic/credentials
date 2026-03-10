<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Update;

use Marktic\Credentials\CredentialSubmissions\Events\ApprovedSubmission;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Approved;

/**
 * Domain action that approves a credential submission.
 * Dispatches an ApprovedSubmission event upon completion.
 */
class ApproveSubmission extends AbstractUpdateSubmissionStatusAction
{
    protected function getNewStatus(): string
    {
        return Approved::NAME;
    }

    protected function dispatchEvent(CredentialSubmission $submission): void
    {
        ApprovedSubmission::dispatch($submission);
    }
}
