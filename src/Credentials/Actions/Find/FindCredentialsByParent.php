<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Actions\Find;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\Credentials\Actions\AbstractAction;

class FindCredentialsByParent extends AbstractAction
{
    use FindRecords;
    use HasSubject;

    protected function findParams(): array
    {
        $subject = $this->getSubject();

        $params = [];
        $params['where'][] = ['parent_id = ? ', $subject->id];
        $params['where'][] = ['parent_type = ? ', $subject->getManager()->getMorphName()];

        return $params;
    }
}
