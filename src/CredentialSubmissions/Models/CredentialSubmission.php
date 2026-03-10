<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRecord;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRecord;
use Marktic\Credentials\CredentialRequirements\ModelsRelated\HasCredentialRequirement\HasCredentialRequirementRecordTrait;
use Marktic\Credentials\Credentials\ModelsRelated\HasCredential\HasCredentialRecordTrait;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Behaviours\HasMembershipStatusesRecordTrait;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Approved;
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

    public function isApproved(): bool
    {
        return $this->isSubmitted() && $this->getStatus()->getName() === Approved::NAME;
    }

    public function setSubmittedBy($submittedBy): static
    {
        $submittedBy = $submittedBy instanceof Record ? $submittedBy->id : $submittedBy;
        $this->submitted_by = $submittedBy;
        return $this;
    }

    public function setApprovedBy($approvedBy): static
    {
        $approvedBy = $approvedBy instanceof Record ? $approvedBy->id : $approvedBy;
        $this->approved_by = $approvedBy;
        $this->approval_date = (string) date('Y-m-d H:i:s');
        return $this;
    }

    public function setRejectedBy($rejectedBy): static
    {
        $rejectedBy = $rejectedBy instanceof Record ? $rejectedBy->id : $rejectedBy;
        $this->rejected_by = $rejectedBy;
        $this->rejection_date = (string) date('Y-m-d H:i:s');
        return $this;
    }


}
