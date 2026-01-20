<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRepository;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRepository;
use Marktic\Credentials\CredentialRequirements\ModelsRelated\HasCredentialRequirement\HasCredentialRequirementRepositoryTrait;
use Marktic\Credentials\Credentials\ModelsRelated\HasCredential\HasCredentialRecordRepositoryTrait;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Behaviours\HasMembershipStatusesRepositoryTrait;

/**
 * Class CredentialSubmissions
 * @package Marktic\Credentials\CredentialSubmissions\Models
 */
class CredentialSubmissions extends CredentialsRepository
{
    use HasParentRepository;
    use HasCredentialRequirementRepositoryTrait;
    use HasCredentialRecordRepositoryTrait;
    use HasMembershipStatusesRepositoryTrait;

    public const TABLE = 'mkt_credential_submissions';

    public const CONTROLLER = 'mkt_credentials-submissions';

    /**
     * @var string
     */
    protected static $createTimestamps = ['created_at', 'submission_date'];

    protected function initRelations(): void
    {
        parent::initRelations();
        $this->initRelationsCredentials();
    }

    protected function initRelationsCredentials(): void
    {
        $this->initRelationsCredentialsParentRecord();
        $this->initRelationsCredentialRequirement();
    }

    /**
     * @inheritDoc
     */
    public function getModelNamespace(): string
    {
        return __NAMESPACE__;
    }
}
