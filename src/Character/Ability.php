<?php
namespace Melindrea\Exalted\Character;

class Ability extends \Melindrea\Exalted\CharacterTrait
{
    public function __construct($name, $value, $favored = false, array $specialties = [])
    {
        parent::__construct($name, $value, $favored, $specialties, false);
    }
}
