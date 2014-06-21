<?php
namespace Melindrea\Exalted\Character;

class Specialty extends \Melindrea\Exalted\CharacterTrait
{
    public function __construct($name, $value)
    {
        if ($value > 3) {
            $value = 3;
        }

        parent::__construct($name, $value);
    }
}
