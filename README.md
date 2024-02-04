# Simple example

```php
use Egusakov\CharacteristicsGenerator\CharacteristicsFactory;
use Egusakov\CharacteristicsGenerator\Entities\ValidRange;
use Egusakov\CharacteristicsGenerator\Rarity\Common;
use Egusakov\CharacteristicsGenerator\Rarity\Epic;
use Egusakov\CharacteristicsGenerator\Rarity\Legendary;
use Egusakov\CharacteristicsGenerator\Rarity\Rare;
use Egusakov\CharacteristicsGenerator\Rarity\Uncommon;

$factory = new CharacteristicsFactory(
    new Common(50, 3, new ValidRange(20, 40)),
    new Uncommon(25, 4, new ValidRange(30, 50)),
    new Rare(15, 5, new ValidRange(40, 60)),
    new Epic(7, 8, new ValidRange(50, 80)),
    new Legendary(3, 10, new ValidRange(80, 100))
);

$characteristics = $factory->create();
```