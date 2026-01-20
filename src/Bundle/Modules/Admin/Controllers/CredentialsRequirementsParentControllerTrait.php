<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\CredentialRequirements\Actions\Find\FindSubmissionsByRequirementsParent;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialRequirementsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsRequirementsParentControllerTrait
{
    use AbstractCredentialsControllerTrait;

    protected function populateCredentialsRequirements($parent)
    {
        $requirements = FindSubmissionsByRequirementsParent::for($parent)->fetch();
        $credentialsRequirementsAdd = CredentialsModels::requirements()->compileURL('add', [
            'parent_type' => $parent->getManager()->getMorphName(),
            'parent_id' => $parent->id,
        ]);

        $this->payload()->with([
            'credentialsRequirements' => $requirements,
            'credentialsRequirementsAdd' => $credentialsRequirementsAdd,
        ]);
    }
}
