# Characteristics Generator

Characteristics Generator is a simple PHP library for generating character characteristics based on their rarity. It is ideal for game and application developers who need to create unique character attributes.

## Installing

The recommended way to install Characteristics Generator is via [Composer](http://getcomposer.org/).

```bash
composer require Eegusakov/characteristics-generator
```

## Simple example

```php
use Eegusakov\CharacteristicsGenerator\CharacteristicsFactory;
use Eegusakov\CharacteristicsGenerator\Entities\ValidRange;
use Eegusakov\CharacteristicsGenerator\Rarity\Common;
use Eegusakov\CharacteristicsGenerator\Rarity\Epic;
use Eegusakov\CharacteristicsGenerator\Rarity\Legendary;
use Eegusakov\CharacteristicsGenerator\Rarity\Rare;
use Eegusakov\CharacteristicsGenerator\Rarity\Uncommon;

$factory = new CharacteristicsFactory(
    new Common(50, 3, new ValidRange(20, 40)),
    new Uncommon(25, 4, new ValidRange(30, 50)),
    new Rare(15, 5, new ValidRange(40, 60)),
    new Epic(7, 8, new ValidRange(50, 80)),
    new Legendary(3, 10, new ValidRange(80, 100))
);

$characteristics = $factory->create();
```

## License

This project is licensed under the MIT license - see the [LICENSE](LICENSE.md) file for details