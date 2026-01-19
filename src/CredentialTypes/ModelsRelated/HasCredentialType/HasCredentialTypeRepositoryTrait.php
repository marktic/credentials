<?php

namespace Marktic\Credentials\CredentialTypes\ModelsRelated\HasCredentialType;


use Marktic\Credentials\Utility\CredentialsModels;

trait HasCredentialTypeRepositoryTrait
{
    public const RELATION_CREDENTIAL_TYPE = 'CredentialType';

    protected function initRelations(): void
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialType();
    }

    /**
     * @inheritDoc
     */
    protected function initRelationsCredentialType()
    {
        $this->belongsTo(
            self::RELATION_CREDENTIAL_TYPE,
            ['class' => CredentialsModels::typesClass(), 'fk' => 'credential_type_id']
        );
    }
}
