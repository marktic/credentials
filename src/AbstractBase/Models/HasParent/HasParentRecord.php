<?php

namespace Marktic\Credentials\AbstractBase\Models\HasParent;

use Nip\Records\Record;

/**
 * Trait HasParentRecord
 * @package Marktic\Credentials\AbstractBase\Models\HasParent
 *
 * @method Record getParentRecord
 */
trait HasParentRecord
{
    public string|int|null $parent_id;
    public string|null $parent_type;

    /**
     * @param Record $record
     */
    public function populateFromParentRecord($record)
    {
        $this->parent_id = $record->id;
        $this->parent_type = $record->getManager()->getMorphName();
        $this->getRelation('ParentRecord')->setResults($record);
    }
}
