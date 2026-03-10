<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\CredentialRequirements\Actions\Find\FindRequirementsByParent;
use Marktic\Credentials\CredentialSubmissions\Actions\Find\FindSubmissionsByParent;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialsSubmissionsParentControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsSubmissionsParentControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function populateCredentialsSubmissions($parent): void
    {
        $submissions = FindSubmissionsByParent::for($parent)->fetch();

        $credentialsSubmissionsAdd = CredentialsModels::submissions()->compileURL('add', [
            'parent_type' => $parent->getManager()->getMorphName(),
            'parent_id' => $parent->id,
        ]);

        $this->payload()->with([
            'credentialsSubmissions' => $submissions,
            'credentialsRequirements' => $requirements,
            'credentialsSubmissionsAdd' => $credentialsSubmissionsAdd,
        ]);
    }

    /**
     */
    protected function populateCredentialsRequirements($parent): void
    {
        $requirements = FindRequirementsByParent::for($parent)->thatIsActive()->fetch();

        $this->payload()->with([
            'credentialsRequirements' => $requirements,
        ]);
    }
}
