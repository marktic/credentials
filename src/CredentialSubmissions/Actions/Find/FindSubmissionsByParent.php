<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Find;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasReturn\HasReturn;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;
use Nip\Records\Collections\Associated;

/**
 * @method CredentialSubmission[]|Associated getReturn()
 */
class FindSubmissionsByParent extends AbstractAction
{
    use FindRecords;
    use HasSubject;
    use HasReturn;

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

        $collection = $collection->keyBy('credential_requirement_id');
        $this->setReturn($collection);
    }

    protected function findParams(): array
    {
        $subject = $this->getSubject();

        $params = [];
        $params['where'][] = ['parent_id = ? ', $subject->id];
        $params['where'][] = ['parent_type = ? ', $subject->getManager()->getMorphName()];
        return $params;
    }

}
