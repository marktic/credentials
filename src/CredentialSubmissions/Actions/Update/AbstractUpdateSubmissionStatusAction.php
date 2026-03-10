<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Update;

use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/**
 * Abstract base action for submission status changes.
 * Handles the common logic of updating the status and dispatching an event.
 */
abstract class AbstractUpdateSubmissionStatusAction extends AbstractAction
{
    use HasSubject;

    /**
     * Returns the new status name to set on the submission.
     */
    abstract protected function getNewStatus(): string;

    /**
     * Dispatches the appropriate event after the status change.
     */
    abstract protected function dispatchEvent(CredentialSubmission $submission): void;

    /**
     * Executes the status change and dispatches the event.
     */
    public function execute(): CredentialSubmission
    {
        /** @var CredentialSubmission $submission */
        $submission = $this->getSubject();
        $submission->setStatus($this->getNewStatus());
        $submission->save();
        $this->dispatchEvent($submission);

        return $submission;
    }
}
