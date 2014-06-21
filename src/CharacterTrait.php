<?php
namespace Melindrea\Exalted;

class CharacterTrait extends Base
{
    public function __construct($name, $value, $favored = false, $description = false, array $specialties = array())
    {
        $this->name = $name;
        $this->value = $value;
        $this->favored = $favored;
        $this->specialties = $specialties;
        $this->description = $description;
    }
}
