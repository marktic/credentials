<?php

declare(strict_types=1);

namespace Marktic\Credentials\Bundle\Modules\Admin\Controllers;

use Marktic\Credentials\Bundle\Modules\Admin\Controllers\Behaviours\HasParentRecordControllerTrait;
use Marktic\Credentials\CredentialRequirements\Actions\Find\FindRequirementsByParent;
use Marktic\Credentials\CredentialRequirements\Models\CredentialRequirement;
use Marktic\Credentials\CredentialSubmissions\Actions\Create\CreateSubmission;
use Marktic\Credentials\Utility\CredentialsModels;

/**
 * Trait CredentialSubmissionsControllerTrait
 * @package Marktic\Credentials\Bundle\Modules\Admin\Controllers
 */
trait CredentialsSubmissionsControllerTrait
{
    use AbstractCredentialsControllerTrait;
    use HasParentRecordControllerTrait;
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

    public function add()
    {
        $parent = $this->getCredentialsParentFromRequest();
        $requirement = $this->getCredentialsRequirementFromRequest();

        if ($this->getRequest()->isMethod('POST')) {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile|null $uploadedFile */
            $uploadedFile = $this->getRequest()->files->get('credential_file');

            if ($requirement === null) {
                $requirementId = $this->getRequest()->get('credential_requirement_id');
                $requirement = $requirementId
                    ? CredentialsModels::requirements()->findOneById($requirementId)
                    : null;
            }

            if (!$requirement instanceof CredentialRequirement) {
                $requirements = FindRequirementsByParent::for($parent)->thatIsActive()->fetch();
                $this->payload()->with([
                    'parent' => $parent,
                    'requirement' => null,
                    'requirements' => $requirements,
                    'error' => translator()->trans('credential_requirement_required'),
                ]);
                return;
            }

            try {
                $action = CreateSubmission::for($parent)->withRequirement($requirement);

                if ($uploadedFile !== null) {
                    $action->withUploadedFile($uploadedFile);
                }

                $action->create();
            } catch (\Exception $e) {
                $requirements = FindRequirementsByParent::for($parent)->thatIsActive()->fetch();
                $this->payload()->with([
                    'parent' => $parent,
                    'requirement' => $requirement,
                    'requirements' => $requirements,
                    'error' => $e->getMessage(),
                ]);
                return;
            }

            $this->redirect($parent->getURL());
            return;
        }

        $requirements = FindRequirementsByParent::for($parent)->thatIsActive()->fetch();

        $this->payload()->with([
            'parent' => $parent,
            'requirement' => $requirement,
            'requirements' => $requirements,
        ]);
    }

    protected function getCredentialsRequirementFromRequest(): ?CredentialRequirement
    {
        $requirementId = $this->getRequest()->get('credential_requirement_id');
        if (!$requirementId) {
            return null;
        }
        $requirement = CredentialsModels::requirements()->findOneById($requirementId);
        return ($requirement instanceof CredentialRequirement) ? $requirement : null;
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
