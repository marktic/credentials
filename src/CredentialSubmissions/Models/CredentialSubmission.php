<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRecord;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRecord;
use Marktic\Credentials\CredentialRequirements\ModelsRelated\HasCredentialRequirement\HasCredentialRequirementRecordTrait;
use Marktic\Credentials\Credentials\ModelsRelated\HasCredential\HasCredentialRecordTrait;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Behaviours\HasMembershipStatusesRecordTrait;
use Nip\Records\AbstractModels\Record;

/**
 * Class CredentialSubmission
 * @package Marktic\Credentials\CredentialSubmissions\Models
 */
class CredentialSubmission extends CredentialsRecord
{
    use HasParentRecord;
    use HasCredentialRecordTrait;
    use HasCredentialRequirementRecordTrait;
    use HasParentRecord;
    use HasMembershipStatusesRecordTrait;

    public function isSubmitted(): bool
    {
        return $this->id > 0;
    }

    public function setSubmittedBy($submittedBy): static
    {
        $submittedBy = $submittedBy instanceof Record ? $submittedBy->id : $submittedBy;
        $this->submitted_by = $submittedBy;
        return $this;
    }


}
