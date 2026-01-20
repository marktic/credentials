<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Models;

use ByTIC\MediaLibrary\HasMedia\HasMediaRecordsTrait;
use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRepository;
use Marktic\Credentials\CredentialTypes\ModelsRelated\HasCredentialType\HasCredentialTypeRepositoryTrait;

/**
 * Class Credentials
 * @package Marktic\Credentials\Credentials\Models
 *
 * @method Credential getNew
 */
class Credentials extends CredentialsRepository
{
    use HasCredentialTypeRepositoryTrait;
    use HasParentRepository;
    use HasMediaRecordsTrait;

    public const TABLE = 'mkt_credential_credentials';

    public const CONTROLLER = 'mkt_credentials-credentials';

    public function initRelations()
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialType();
        $this->initRelationsCredentialsParentRecord();
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
