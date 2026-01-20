<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Find;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasReturn\HasReturn;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialRequirements\Actions\Find\FindCredentialsByParent;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Approved;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Pending;
use Nip\Records\Collections\Associated;

/**
 * @method CredentialSubmission[]|Associated getReturn()
 */
class FindSubmissionsByRequirementsParent extends AbstractAction
{
    use FindRecords;
    use HasSubject;
    use HasReturn;

    protected $requirementsParent;
    protected $requirements = null;
    protected $submittedBy = null;

    public static function for($parent, $requirementsParent)
    {
        $action = new static();
        $action->setSubject($parent);
        $action->requirementsParent = $requirementsParent;
        return $action;
    }

    public function submittedBy($submittedBy): static
    {
        $this->submittedBy = $submittedBy;
        return $this;
    }

    public function fetch()
    {
        return $this->getReturn();
    }

    protected function generateNewReturn()
    {
        return $this->findAll();
    }

    protected function populateReturn()
    {
        $collection = $this->getReturn();
        $collection->loadRelation(CredentialSubmissions::RELATION_CREDENTIAL_REQUIREMENT);
//        $collection->loadRelation(CredentialSubmissions::RELATION_PARENT_RECORD);

        $collection->keyBy('credential_requirement_id');
        $requirements = $this->getRequirements();
        foreach ($requirements as $requirement) {
            if ($collection->has($requirement->id)) {
                continue;
            }
            $submission = $this->createNewSubmission($requirement);
            $collection->add($submission, $requirement->id);
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

    private function getRequirementsIds()
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
        return FindCredentialsByParent
            ::for($this->requirementsParent)
            ->thatIsActive()
            ->fetch();
    }

    protected function createNewSubmission($requirement)
    {
        /** @var CredentialSubmission $submission */
        $submission = $this->getRepository()->getNew();
        $submission->populateFromParentRecord($this->getSubject());
        $submission->populateFromCredentialRequirement($requirement);

        if ($this->submittedBy) {
            $submission->setSubmittedBy($this->submittedBy);
        }

        $submission->setStatus(Pending::NAME);

        return $submission;
    }
}
