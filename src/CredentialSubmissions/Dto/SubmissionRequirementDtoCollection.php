<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Dto;

class SubmissionRequirementDtoCollection
{
    /** @var SubmissionRequirementDTO[] */
    private array $items = [];

    public function add(SubmissionRequirementDTO $dto): void
    {
        $this->items[] = $dto;
    }

    /** @return SubmissionRequirementDTO[] */
    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function areRequiredValidated(): bool
    {
        foreach ($this->items as $dto) {
            if ($dto->getRequirement()->isMandatory() && !$dto->hasValidSubmission()) {
                return false;
            }
        }

        return true;
    }
}
