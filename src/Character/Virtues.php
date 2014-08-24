<?php
namespace Melindrea\Exalted\Character;

use Melindrea\Exalted\CharacterTrait as CTrait;

class Virtues extends Traits
{
    public function __construct($compassion, $conviction, $temperance, $valor)
    {
        $traits = [
            CTrait::factory('Virtue', 'Compassion', $compassion),
            CTrait::factory('Virtue', 'Conviction', $conviction),
            CTrait::factory('Virtue', 'Temperance', $temperance),
            CTrait::factory('Virtue', 'Valor', $valor),
        ];

        parent::__construct('Virtues', $traits);
    }
}
