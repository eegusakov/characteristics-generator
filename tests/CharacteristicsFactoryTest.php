<?php

namespace CharacteristicsGenerator;

use Egusakov\CharacteristicsGenerator\CharacteristicsFactory;
use Egusakov\CharacteristicsGenerator\Entities\Characteristics;
use Egusakov\CharacteristicsGenerator\Interfaces\ValidRangeInterface;
use Egusakov\CharacteristicsGenerator\Rarity\Rarity;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

#[CoversClass(CharacteristicsFactory::class)]
#[UsesClass(Characteristics::class)]
class CharacteristicsFactoryTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess()
    {
        $common = $this->createMock(Rarity::class);
        $common->method('getAllowedSumCharacteristics')->willReturn(56);
        $common->method('getDropChance')->willReturn(50);
        $common->method('getAgility')->willReturn(10);
        $common->method('getEnergy')->willReturn(3);
        $common->method('getHealth')->willReturn(60);

        $validRangeCommon = $this->createMock(ValidRangeInterface::class);
        $validRangeCommon->method('getMin')->willReturn(20);
        $validRangeCommon->method('getMax')->willReturn(40);

        $common->method('getValidRangeCharacteristics')->willReturn($validRangeCommon);

        $uncommon = $this->createMock(Rarity::class);
        $uncommon->method('getAllowedSumCharacteristics')->willReturn(70);
        $uncommon->method('getDropChance')->willReturn(50);
        $uncommon->method('getAgility')->willReturn(15);
        $uncommon->method('getEnergy')->willReturn(4);
        $uncommon->method('getHealth')->willReturn(120);

        $validRangeUncommon = $this->createMock(ValidRangeInterface::class);
        $validRangeUncommon->method('getMin')->willReturn(30);
        $validRangeUncommon->method('getMax')->willReturn(50);

        $uncommon->method('getValidRangeCharacteristics')->willReturn($validRangeUncommon);

        $factory = new CharacteristicsFactory(
            $common,
            $uncommon
        );

        $characteristics = $factory->create();

        $this->assertIsString($characteristics->rarity);
        $this->assertIsInt($characteristics->strength);
        $this->assertThat($characteristics->strength, $this->logicalAnd(
            $this->greaterThanOrEqual(20),
            $this->lessThanOrEqual(50)
        ));
        $this->assertIsInt($characteristics->protection);
        $this->assertThat($characteristics->protection, $this->logicalAnd(
            $this->greaterThanOrEqual(20),
            $this->lessThanOrEqual(50)
        ));
        $this->assertIsInt($characteristics->agility);
        $this->assertIsInt($characteristics->health);
        $this->assertIsInt($characteristics->energy);
    }

    /**
     * @throws Exception
     */
    public function testError()
    {
        $this->expectException(InvalidArgumentException::class);

        $common = $this->createMock(Rarity::class);
        $common->method('getDropChance')->willReturn(50);

        $uncommon = $this->createMock(Rarity::class);
        $uncommon->method('getDropChance')->willReturn(40);

        new CharacteristicsFactory(
            $common,
            $uncommon
        );
    }
}
