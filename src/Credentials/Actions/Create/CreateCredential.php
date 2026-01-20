<?php

namespace Marktic\Credentials\Credentials\Actions\Create;

use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\Credentials\Actions\AbstractAction;
use Marktic\Credentials\Credentials\Models\Credential;
use Marktic\Credentials\CredentialTypes\Models\CredentialType;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCredential extends AbstractAction
{
    use HasSubject;

    protected $credentialType = null;
    protected $uploadedFile = null;

    public function withCredentialType($credentialType): static
    {
        $this->credentialType = $credentialType;
        return $this;
    }

    public function withUploadedFile(UploadedFile $file): static
    {
        $this->uploadedFile = $file;
        return $this;
    }

    public function newRecord(): Credential
    {
        $record = $this->getRepository()->getNew();
        $record->populateFromParentRecord($this->getSubject());
        if ($this->credentialType instanceof CredentialType) {
            $record->populateFromCredentialType($this->credentialType);
        } else {
            throw new RuntimeException('CredentialType is required to create Credential');
        }
        return $record;
    }

    public function create(): Credential
    {
        $record = $this->newRecord();
        $record->save();

        if ($this->uploadedFile instanceof UploadedFile) {
            $record->uploadFromRequest($this->uploadedFile);
        }
        return $record;
    }
}