<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Events;

use ByTIC\EventDispatcher\Events\Dispatchable;
use ByTIC\EventDispatcher\Events\GenericEvent;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

/**
 * Abstract base event for submission status changes.
 */
abstract class AbstractSubmissionStatusChangedEvent extends GenericEvent
{
    use Dispatchable;

    public function __construct(CredentialSubmission $submission)
    {
        parent::__construct($submission);
    }

    public function getSubmission(): CredentialSubmission
    {
        return $this->subject;
    }
}
