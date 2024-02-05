<?php

namespace CharacteristicsGenerator\Entities;

use Eegusakov\CharacteristicsGenerator\Entities\ValidRange;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ValidRange::class)]
final class ValidRangeTest extends TestCase
{
    public function testSuccess(): void
    {
        $validRange = new ValidRange(10, 20);

        $this->assertEquals(10, $validRange->getMin());
        $this->assertEquals(20, $validRange->getMax());
    }

    public function testError(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $validRange = new ValidRange(20, 10);
    }
}
