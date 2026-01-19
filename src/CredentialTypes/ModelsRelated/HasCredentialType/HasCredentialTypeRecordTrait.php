<?php

namespace Marktic\Credentials\CredentialTypes\ModelsRelated\HasCredentialType;

use Marktic\Credentials\CredentialTypes\Models\CredentialType;

/**
 * @method CredentialType getCredentialType()
 */
trait HasCredentialTypeRecordTrait
{
    public int|string|null $credential_type_id = null;

    public function populateFromCredentialType(CredentialType $record): self
    {
        $this->credential_type_id = $record->id;
        $this->getRelation('CredentialType')->setResults($record);
        return $this;
    }
}
