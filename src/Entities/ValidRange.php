<?php

declare(strict_types=1);

namespace Egusakov\CharacteristicsGenerator\Entities;

use Egusakov\CharacteristicsGenerator\Interfaces\ValidRangeInterface;
use InvalidArgumentException;

final readonly class ValidRange implements ValidRangeInterface
{
    private int $min;
    private int $max;

    public function __construct(int $min, int $max)
    {
        if ($min > $max) {
            throw new InvalidArgumentException('The minimum range value cannot be greater than the maximum');
        }

        $this->min = $min;
        $this->max = $max;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }
}