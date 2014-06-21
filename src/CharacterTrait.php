<?php
namespace Melindrea\Exalted;

class CharacterTrait extends Base
{
    public function __construct($name, $value, $favored = false, array $specialties = array(), $description = false)
    {
        if ($value < 0) {
            $value = 0;
        }

        $this->name = $name;
        $this->value = $value;
        $this->favored = (bool) $favored;
        $this->specialties = $specialties;
        $this->description = $description;
    }
}
