<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Dto;

use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;

class SubmissionRequirementDTO
{
    public function __construct(
        private readonly CredentialRequirement $requirement,
        private readonly ?CredentialSubmission $submission = null
    ) {
    }

    public function getRequirement(): CredentialRequirement
    {
        return $this->requirement;
    }

    public function getSubmission(): ?CredentialSubmission
    {
        return $this->submission;
    }

    public function hasSubmission(): bool
    {
        return $this->submission !== null && $this->submission->isSubmitted();
    }

    public function hasValidSubmission(): bool
    {
        if (!$this->hasSubmission()) {
            return false;
        }

        return $this->submission->isApproved();
    }
}
