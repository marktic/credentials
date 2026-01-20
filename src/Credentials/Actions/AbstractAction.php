<?php

namespace Marktic\Credentials\Credentials\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\Entities\HasRepository;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirements;
use Marktic\Credentials\Utility\CredentialsModels;
use Nip\Records\AbstractModels\RecordManager;

/**
 * @method CredentialRequirements getRepository
 */
abstract class AbstractAction extends Action
{
    use HasRepository;

    protected function generateRepository(): RecordManager
    {
        return CredentialsModels::credentials();
    }
}