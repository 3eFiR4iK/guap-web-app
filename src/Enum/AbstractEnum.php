<?php

namespace App\Enum;

use JsonSerializable;
use MyCLabs\Enum\Enum;

abstract class AbstractEnum extends Enum implements JsonSerializable
{
    public function jsonSerialize()
    {
        return $this->getValue();
    }
}
