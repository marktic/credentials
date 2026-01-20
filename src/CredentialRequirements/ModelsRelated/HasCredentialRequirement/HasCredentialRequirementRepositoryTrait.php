<?php

namespace Marktic\Credentials\CredentialRequirements\ModelsRelated\HasCredentialRequirement;


use Marktic\Credentials\Utility\CredentialsModels;

trait HasCredentialRequirementRepositoryTrait
{
    public const RELATION_CREDENTIAL_REQUIREMENT = 'CredentialRequirement';

    protected function initRelations(): void
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialRequirement();
    }

    /**
     * @inheritDoc
     */
    protected function initRelationsCredentialRequirement()
    {
        $this->belongsTo(
            self::RELATION_CREDENTIAL_REQUIREMENT,
            ['class' => CredentialsModels::requirementsClass(), 'fk' => 'credential_requirement_id']
        );
    }
}
