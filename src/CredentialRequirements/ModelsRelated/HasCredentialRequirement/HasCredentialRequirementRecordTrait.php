<?php

namespace Marktic\Credentials\CredentialRequirements\ModelsRelated\HasCredentialRequirement;

use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;

/**
 * @method CredentialRequirement getCredentialRequirement()
 */
trait HasCredentialRequirementRecordTrait
{
    public int|string|null $credential_requirement_id = null;

    public function populateFromCredentialRequirement(CredentialRequirement $record): self
    {
        $this->credential_requirement_id = $record->id;
        $this->getRelation(CredentialSubmissions::RELATION_CREDENTIAL_REQUIREMENT)->setResults($record);
        return $this;
    }
}
