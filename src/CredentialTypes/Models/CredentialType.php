<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialTypes\Models;

use Marktic\Credentials\AbstractBase\Models\CredentialsRecord;

/**
 * Class CredentialType
 * @package Marktic\Credentials\CredentialTypes\Models
 */
class CredentialType extends CredentialsRecord
{
    public $name = null;
    public $label = null;

    public $description = null;

    public $is_active = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLead()
    {
        return $this->lead;
    }

    public function isActive(): bool
    {
        return (bool)$this->is_active;
    }
}
