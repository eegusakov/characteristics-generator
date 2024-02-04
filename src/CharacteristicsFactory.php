<?php

declare(strict_types=1);

namespace Egusakov\CharacteristicsGenerator;

use DomainException;
use Egusakov\CharacteristicsGenerator\Entities\Characteristics;
use Egusakov\CharacteristicsGenerator\Rarity\Rarity;
use InvalidArgumentException;

final class CharacteristicsFactory
{
    private array $rarities;

    public function __construct(Rarity ...$rarities)
    {
        $totalPercent = 0;
        foreach ($rarities as $rarity) {
            $totalPercent += $rarity->getDropChance();
        }

        if ($totalPercent !== 100) {
            throw new InvalidArgumentException('The final sum of probabilities must be equal to 100%');
        }

        $this->rarities = $rarities;
    }

    /**
     * Главный метод? создающий характеристики персонажа
     *
     * @return Characteristics
     */
    public function create(): Characteristics
    {
        $cumulativeChance = 0;
        $randomNumber = rand(1, 100);

        usort($this->rarities, function (Rarity $first, Rarity $second) {
            return $first->getDropChance() - $second->getDropChance();
        });

        $characteristics = new Characteristics();
        foreach ($this->rarities as $rarity) {
            $cumulativeChance += $rarity->getDropChance();

            if ($randomNumber <= $cumulativeChance) {
                $characteristics->generate($rarity);

                return $characteristics;
            }
        }

        throw new DomainException('Could not determine rarity');
    }
}
