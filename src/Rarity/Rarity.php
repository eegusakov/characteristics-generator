<?php

declare(strict_types=1);

namespace Eegusakov\CharacteristicsGenerator\Rarity;

use Eegusakov\CharacteristicsGenerator\Interfaces\ValidRangeInterface;

abstract class Rarity
{
    public function __construct(
        protected int $dropChance,
        protected int $energy,
        protected ValidRangeInterface $validRangeCharacteristics
    ) {
    }

    /**
     * Возвращает допустимую сумму характеристик, генерирующихся случайным образом
     *
     * Расчитывается по формуле:
     *      <максимальное_значение_характеристики> * <кол-во_генерируемых_характеристик> - 30%
     *
     * @return int
     */
    public function getAllowedSumCharacteristics(): int
    {
        return (int) ($this->validRangeCharacteristics->getMax() * 2 * ((100 - 30) / 100));
    }

    /**
     * Возвращает шанс выпадения данной редкости в процентах
     *
     * @return int
     */
    public function getDropChance(): int
    {
        return $this->dropChance;
    }

    /**
     * Возвращает количество ловкости доступной персонажу данной редкости
     *
     * @return int
     */
    public function getAgility(): int
    {
        return (int) ($this->validRangeCharacteristics->getMin() / 2);
    }

    /**
     * Возвращает количество энергии доступной персонажу данной редкости
     *
     * @return int
     */
    public function getEnergy(): int
    {
        return $this->energy;
    }

    /**
     * Возвращает количество здоровья доступного персонажу данной редкости
     *
     * @return int
     */
    public function getHealth(): int
    {
        return (int) ($this->validRangeCharacteristics->getMin()) * 3;
    }

    /**
     * Возвращает диапазон значений генерируемых характеристик доступные персонажу данной редкости
     *
     * @return ValidRangeInterface
     */
    public function getValidRangeCharacteristics(): ValidRangeInterface
    {
        return $this->validRangeCharacteristics;
    }
}
