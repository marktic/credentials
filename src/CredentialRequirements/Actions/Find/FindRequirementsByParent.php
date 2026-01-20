<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialRequirements\Actions\Find;

use Bytic\Actions\Behaviours\Entities\FindRecords;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialRequirements\Actions\AbstractAction;

class FindRequirementsByParent extends AbstractAction
{
    use FindRecords;
    use HasSubject;

    protected const PARAM_IS_ACTIVE = 'is_active';

    public function thatIsActive($value = true): self
    {
        return $this->setAttribute(self::PARAM_IS_ACTIVE, $value);
    }

    protected function findParams(): array
    {
        $subject = $this->getSubject();

        $params = [];
        $params['where'][] = ['parent_id = ? ', $subject->id];
        $params['where'][] = ['parent_type = ? ', $subject->getManager()->getMorphName()];

        if ($this->getAttribute(self::PARAM_IS_ACTIVE) === true) {
            $params['where'][] = ['is_active = ? ', 1];
        } elseif ($this->getAttribute(self::PARAM_IS_ACTIVE) === false) {
            $params['where'][] = ['is_active = ? ', 0];
        }
        return $params;
    }
}
