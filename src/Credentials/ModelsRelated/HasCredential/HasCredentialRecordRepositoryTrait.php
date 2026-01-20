<?php

namespace Marktic\Credentials\Credentials\ModelsRelated\HasCredential;


use Marktic\Credentials\Utility\CredentialsModels;

trait HasCredentialRecordRepositoryTrait
{
    public const RELATION_CREDENTIAL_RECORD = 'CredentialRecord';

    protected function initRelations(): void
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialRecord();
    }

    /**
     * @inheritDoc
     */
    protected function initRelationsCredentialRecord()
    {
        $this->belongsTo(
            self::RELATION_CREDENTIAL_RECORD,
            ['class' => CredentialsModels::credentialsClass(), 'fk' => 'credential_credential_id']
        );
    }
}
