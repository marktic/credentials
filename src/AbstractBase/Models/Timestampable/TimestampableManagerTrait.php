<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Models\Timestampable;

trait TimestampableManagerTrait
{
    use \ByTIC\DataObjects\Behaviors\Timestampable\TimestampableManagerTrait;

    /**
     * @var string
     */
    protected static $createTimestamps = ['created_at'];

    /**
     * @var string
     */
    protected static $updateTimestamps = ['updated_at'];
}
