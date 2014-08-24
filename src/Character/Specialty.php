<?php
namespace Melindrea\Exalted\Character;

class Specialty extends \Melindrea\Exalted\CharacterTrait
{
    public function __construct($name, $value)
    {
        parent::__construct($name, $value, false, [], false, 3);
    }
}
