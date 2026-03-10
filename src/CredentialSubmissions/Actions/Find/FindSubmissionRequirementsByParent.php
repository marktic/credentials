<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Find;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialRequirements\Actions\Find\FindRequirementsByParent;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Dto\SubmissionRequirementDTO;
use Marktic\Credentials\CredentialSubmissions\Dto\SubmissionRequirementDtoCollection;

class FindSubmissionRequirementsByParent extends AbstractAction
{
    use FindRecords;
    use HasSubject;

    protected $requirementsParent;
    protected $requirements = null;

    private ?SubmissionRequirementDtoCollection $dtoCollection = null;

    public static function for($parent, $requirementsParent): static
    {
        $action = new static();
        $action->setSubject($parent);
        $action->requirementsParent = $requirementsParent;
        return $action;
    }

    public function fetch(): SubmissionRequirementDtoCollection
    {
        if ($this->dtoCollection === null) {
            $this->dtoCollection = $this->buildDtoCollection();
        }
        return $this->dtoCollection;
    }

    public function areRequiredValidated(): bool
    {
        return $this->fetch()->areRequiredValidated();
    }

    protected function buildDtoCollection(): SubmissionRequirementDtoCollection
    {
        $submissionsRaw = $this->findAll();
        $submissionsByRequirementId = [];
        foreach ($submissionsRaw as $submission) {
            $submissionsByRequirementId[$submission->credential_requirement_id] = $submission;
        }

        $requirements = $this->getRequirements();
        $collection = new SubmissionRequirementDtoCollection();
        foreach ($requirements as $requirement) {
            $submission = $submissionsByRequirementId[$requirement->id] ?? null;
            $collection->add(new SubmissionRequirementDTO($requirement, $submission));
        }

        return $collection;
    }

    protected function findParams(): array
    {
        $subject = $this->getSubject();

        $params = [];
        $params['where'][] = ['parent_id = ? ', $subject->id];
        $params['where'][] = ['parent_type = ? ', $subject->getManager()->getMorphName()];
        $params['where'][] = ['credential_requirement_id = ?', $this->getRequirementsIds()];
        return $params;
    }

    private function getRequirementsIds(): array
    {
        return $this->getRequirements()->pluck('id')->toArray();
    }

    public function getRequirements()
    {
        if ($this->requirements === null) {
            $this->requirements = $this->findRequirements();
        }
        return $this->requirements;
    }

    protected function findRequirements()
    {
        return FindRequirementsByParent::for($this->requirementsParent)
            ->thatIsActive()
            ->fetch();
    }
}
