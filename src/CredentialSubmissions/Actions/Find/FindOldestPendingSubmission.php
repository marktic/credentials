<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Find;

use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Pending;

/**
 * Finds the oldest pending submission, optionally excluding specific IDs.
 */
class FindOldestPendingSubmission extends AbstractAction
{
    protected array $excludeIds = [];

    public function excludingIds(array $ids): static
    {
        $this->excludeIds = array_values(array_filter(array_map('intval', $ids)));

        return $this;
    }

    public function fetch(): ?CredentialSubmission
    {
        $params = [
            'where' => [
                ['status = ?', Pending::NAME],
            ],
            'order' => 'id ASC',
            'limit' => '1',
        ];

        if (!empty($this->excludeIds)) {
            $ids = implode(',', array_map('intval', $this->excludeIds));
            $params['where'][] = ["id NOT IN ($ids)"];
        }

        $result = $this->getRepository()->findOne($params);

        return ($result instanceof CredentialSubmission) ? $result : null;
    }
}
