<?php
namespace Melindrea\Exalted\Character;

class Background extends \Melindrea\Exalted\CharacterTrait
{
    public function __construct($name, $value, $description)
    {
        parent::__construct($name, $value, false, [], $description);
    }
}
