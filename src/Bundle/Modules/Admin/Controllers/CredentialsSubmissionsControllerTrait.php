<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use KM42\Membership\Domain\Memberships\Events\MembershipActivated;
use KM42\Membership\Domain\Memberships\MembershipStatuses\Statuses\Active;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialSubmissionsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsSubmissionsControllerTrait
{
    use AbstractCredentialsControllerTrait;
    use \ByTIC\Controllers\Behaviors\HasStatus {
        changeSmartPropertyValueUpdate as changeSmartPropertyValueUpdateParent;
    }

    public function view()
    {
        $item = $this->getModelFromRequest();
        $this->initViewStatuses();
        $this->payload()->with([
            'item' => $item
        ]);
    }

    protected function changeSmartPropertyValueUpdate($definitionName, $item, $value)
    {
        $this->changeSmartPropertyValueUpdateParent($definitionName, $item, $value);
    }

    protected function generateModelName(): string
    {
        return CredentialsModels::submissionsClass();
    }
}
