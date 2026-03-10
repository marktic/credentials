<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Update;

use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Events\AbstractSubmissionStatusChangedEvent;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/**
 * Abstract base action for submission status changes.
 * Handles updating the status, saving, and dispatching the event.
 * Concrete subclasses declare only the new status and event class.
 */
abstract class AbstractUpdateSubmissionStatusAction extends AbstractAction
{
    use HasSubject;

    protected mixed $moderator = null;

    public function withModerator(mixed $moderator): static
    {
        $this->moderator = $moderator;
        return $this;
    }

    /**
     * Returns the new status name to set on the submission.
     */
    abstract protected function getNewStatus(): string;

    /**
     * Returns the FQCN of the event to dispatch after the status change.
     *
     * @return class-string<AbstractSubmissionStatusChangedEvent>
     */
    abstract protected function getEventClass(): string;

    /**
     * Executes the status change and dispatches the event.
     */
    public function execute(): CredentialSubmission
    {
        /** @var CredentialSubmission $submission */
        $submission = $this->getSubject();
        $submission->setStatus($this->getNewStatus());
        $this->populateAdditionalFields();
        $submission->save();

        $eventClass = $this->getEventClass();
        $eventClass::dispatch($submission);

        return $submission;
    }

    protected function populateAdditionalFields(): void
    {
    }
}
