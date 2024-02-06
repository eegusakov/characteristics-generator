<?php

namespace CharacteristicsGenerator\Entities;

use Eegusakov\CharacteristicsGenerator\Entities\Characteristics;
use Eegusakov\CharacteristicsGenerator\Interfaces\ValidRangeInterface;
use Eegusakov\CharacteristicsGenerator\Rarity\Rarity;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Characteristics::class)]
class CharacteristicsTest extends TestCase
{
    public function testGenerate()
    {
        $this->assertIsInt(1, 1);

        $rarity = $this->createMock(Rarity::class);
        $rarity->method('getAllowedSumCharacteristics')->willReturn(56);
        $rarity->method('getDropChance')->willReturn(50);
        $rarity->method('getAgility')->willReturn(10);
        $rarity->method('getEnergy')->willReturn(3);
        $rarity->method('getHealth')->willReturn(120);

        $validRange = $this->createMock(ValidRangeInterface::class);
        $validRange->method('getMin')->willReturn(20);
        $validRange->method('getMax')->willReturn(40);

        $rarity->method('getValidRangeCharacteristics')->willReturn($validRange);

        $characteristics = new Characteristics();
        $characteristics->generate($rarity);

        $this->assertIsString($characteristics->rarity);
        $this->assertIsInt($characteristics->strength);
        $this->assertThat($characteristics->strength, $this->logicalAnd(
            $this->greaterThanOrEqual(20),
            $this->lessThanOrEqual(40)
        ));
        $this->assertIsInt($characteristics->defence);
        $this->assertThat($characteristics->defence, $this->logicalAnd(
            $this->greaterThanOrEqual(20),
            $this->lessThanOrEqual(40)
        ));
        $this->assertIsInt($characteristics->agility);
        $this->assertEquals(10, $characteristics->agility);
        $this->assertIsInt($characteristics->health);
        $this->assertEquals(120, $characteristics->health);
        $this->assertIsInt($characteristics->energy);
        $this->assertEquals(3, $characteristics->energy);
    }
}
