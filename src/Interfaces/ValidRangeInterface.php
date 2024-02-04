<?php

namespace Egusakov\CharacteristicsGenerator\Interfaces;

/**
 * @codeCoverageIgnore
 */
interface ValidRangeInterface
{
    public function getMax(): int;

    public function getMin(): int;
}