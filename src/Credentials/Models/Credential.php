<?php

declare(strict_types=1);

namespace Marktic\Credentials\Credentials\Models;

use ByTIC\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use ByTIC\MediaLibrary\UrlGenerator\BaseUrlGenerator;
use Marktic\Credentials\AbstractBase\Models\CredentialsRecord;
use Marktic\Credentials\AbstractBase\Models\HasParent\HasParentRecord;
use Marktic\Credentials\CredentialTypes\ModelsRelated\HasCredentialType\HasCredentialTypeRecordTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Credential
 * @package Marktic\Credentials\Credentials\Models
 */
class Credential extends CredentialsRecord implements HasMedia
{
    use HasCredentialTypeRecordTrait;
    use HasParentRecord;
    use HasMediaTrait;

    public ?string $name = null;

    public function getName(): ?string
    {
        if ($this->name) {
            return $this->name;
        }
        return 'File #' . $this->id;
    }

    public function getFile()
    {
        $fileCollection = $this->getFiles();
        return $fileCollection->first();
    }

    public function getFileUrl(): ?BaseUrlGenerator
    {
        $file = $this->getFile();
        if (!$file) {
            return null;
        }
        return $file->getUrl();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string|boolean
     */
    public function uploadFromRequest($uploadedFile)
    {
        $fileCollection = $this->getFiles();

        if (!$uploadedFile->isValid()) {
            return $uploadedFile->getErrorMessage();
        }

        try {
            $fileAdder = $this->addFile($uploadedFile);
            $newMedia = $fileAdder->getMedia();
        } catch (FileUnacceptableForCollection $exception) {
            return $exception->violations->getMessageString();
        }

        foreach ($fileCollection as $name => $media) {
            if ($name != $newMedia->getName()) {
                $media->delete();
            }
        }
        return $newMedia;
    }
}
