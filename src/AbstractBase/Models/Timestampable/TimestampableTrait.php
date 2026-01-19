<?php

declare(strict_types=1);

namespace Marktic\Credentials\AbstractBase\Models\Timestampable;

trait TimestampableTrait
{
    use \ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;

    /**
     * @var string
     */
    protected static $createTimestamps = ['created_at'];

    /**
     * @var string
     */
    protected static $updateTimestamps = ['updated_at'];
}
