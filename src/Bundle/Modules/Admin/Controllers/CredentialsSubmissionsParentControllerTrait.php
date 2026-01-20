<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\CredentialSubmissions\Actions\Find\FindSubmissionsByParent;

/**
 * Trait CredentialsSubmissionsParentControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsSubmissionsParentControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function populateCredentialsRequirements($parent): void
    {
        $submissions = FindSubmissionsByParent::for($parent)->fetch();

        $this->payload()->with([
            'credentialsSubmissions' => $submissions,
        ]);
    }
}
