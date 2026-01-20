<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialSubmissionsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsSubmissionsControllerTrait
{
    use AbstractCredentialsControllerTrait;

    public function view()
    {
        $item = $this->getModelFromRequest();
        $this->payload()->with([
            'item' => $item
        ]);
    }

    protected function generateModelName(): string
    {
        return CredentialsModels::submissionsClass();
    }
}
