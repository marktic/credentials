<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Behaviours;

use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait;
use KM42\Membership\Domain\Memberships\MembershipStatuses\Statuses\AbstractStatus;

/**
 *
 */
trait HasMembershipStatusesRepositoryTrait
{
    use RecordsTrait;

    /**
     * @return string
     */
    public function getStatusesDirectory(): string
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.'Statuses';
    }

    /**
     * @inheritdoc
     */
    public function getStatusNamespace(): string
    {
        $namespace = str_replace('AbstractStatus', '', AbstractStatus::class);

        return $namespace;
    }
}
