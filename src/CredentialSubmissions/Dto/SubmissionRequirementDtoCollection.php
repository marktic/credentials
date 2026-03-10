<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Dto;

use Nip\Collections\Typed\ClassCollection;

/**
 * @method SubmissionRequirementDTO[] all()
 */
class SubmissionRequirementDtoCollection extends ClassCollection
{
    protected $validClass = SubmissionRequirementDTO::class;

    public function areRequiredValidated(): bool
    {
        foreach ($this as $dto) {
            if ($dto->getRequirement()->isMandatory() && !$dto->hasValidSubmission()) {
                return false;
            }
        }

        return true;
    }
}
