<?php

namespace Marktic\Credentials\Credentials\ModelsRelated\HasCredential;

use Marktic\Credentials\Credentials\Models\Credential;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmissions;

/**
 * @method Credential getCredentialRecord()
 */
trait HasCredentialRecordTrait
{
    public int|string|null $credential_credential_id = null;

    public function hasCredentialRecord(): bool
    {
        return $this->credential_credential_id > 0;
    }

    public function populateFromCredentialRecord(Credential $record): self
    {
        $this->credential_credential_id = $record->id;
        $this->getRelation(CredentialSubmissions::RELATION_CREDENTIAL_RECORD)->setResults($record);
        return $this;
    }
}
