<?php

declare(strict_types=1);

namespace Marktic\Credentials\CredentialSubmissions\Actions\Create;

use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Actions\AbstractAction;
use Marktic\Credentials\CredentialSubmissions\Models\CredentialSubmission;
use Marktic\Credentials\CredentialSubmissions\SubmissionStatuses\Statuses\Pending;
use Marktic\Credentials\Credentials\Actions\Create\CreateCredential;
use Marktic\Credentials\Credentials\Models\Credential;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Creates a CredentialSubmission together with the underlying Credential record.
 *
 * Shared action used by both admin and frontend modules.
 * Use withSubmittedBy() to signal which user (admin or frontend user) performed the submission.
 */
class CreateSubmission extends AbstractAction
{
    use HasSubject;

    protected ?CredentialRequirement $credentialRequirement = null;

    protected ?UploadedFile $uploadedFile = null;

    protected mixed $submittedBy = null;

    public function withRequirement(CredentialRequirement $requirement): static
    {
        $this->credentialRequirement = $requirement;
        return $this;
    }

    public function withUploadedFile(UploadedFile $file): static
    {
        $this->uploadedFile = $file;
        return $this;
    }

    /**
     * Set the user (admin or frontend) who is performing the submission.
     * Pass an admin user record when submitting from the admin module,
     * or a frontend user record when submitting from the frontend module.
     */
    public function withSubmittedBy(mixed $submittedBy): static
    {
        $this->submittedBy = $submittedBy;
        return $this;
    }

    public function create(): CredentialSubmission
    {
        if (!$this->credentialRequirement instanceof CredentialRequirement) {
            throw new RuntimeException('CredentialRequirement is required to create a CredentialSubmission');
        }

        $credential = $this->createCredential();
        $submission = $this->buildSubmission($credential);
        $submission->save();

        return $submission;
    }

    protected function createCredential(): Credential
    {
        $credentialType = $this->credentialRequirement->getCredentialType();

        $action = CreateCredential::for($this->getSubject())
            ->withCredentialType($credentialType);

        if ($this->uploadedFile instanceof UploadedFile) {
            $action->withUploadedFile($this->uploadedFile);
        }

        return $action->create();
    }

    protected function buildSubmission(Credential $credential): CredentialSubmission
    {
        /** @var CredentialSubmission $submission */
        $submission = $this->getRepository()->getNew();
        $submission->populateFromParentRecord($this->getSubject());
        $submission->populateFromCredentialRequirement($this->credentialRequirement);
        $submission->populateFromCredentialRecord($credential);
        $submission->setStatus(Pending::NAME);

        if ($this->submittedBy !== null) {
            $submission->setSubmittedBy($this->submittedBy);
        }

        return $submission;
    }
}
