<?php

declare(strict_types=1);

namespace Eegusakov\CharacteristicsGenerator\Entities;

use Eegusakov\CharacteristicsGenerator\Rarity\Rarity;

final class Characteristics
{
    public string $rarity;
    public int $strength;
    public int $defence;
    public int $agility;
    public int $health;
    public int $energy;

    public function generate(Rarity $rarity): void
    {
        $this->rarity = basename(str_replace('\\', '/', get_class($rarity)));

        $limit = $rarity->getAllowedSumCharacteristics();
        $validRange = $rarity->getValidRangeCharacteristics();

        $characteristicOne = rand($validRange->getMin(), $validRange->getMax());
        $limit -= $characteristicOne;
        $characteristicTwo = rand($validRange->getMin(), $validRange->getMax());
        if ($limit < $characteristicTwo) {
            $characteristicTwo = $limit;

            if ($characteristicTwo < $validRange->getMin()) {
                $characteristicTwo = $validRange->getMin();
            }
        }

        $characteristics = [$characteristicOne, $characteristicTwo];

        shuffle($characteristics);

        $this->strength = $characteristics[0];
        $this->defence = $characteristics[1];

        $this->agility = $rarity->getAgility();
        $this->energy = $rarity->getEnergy();
        $this->health = $rarity->getHealth();
    }
}
