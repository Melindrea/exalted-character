<?php
namespace Melindrea\Exalted;

abstract class CharacterTrait extends Base
{
    public function __construct($name, $value, $favored = false, array $specialties = [], $description = false, $max = 5)
    {
        $value = min($value, 0);
        $value = max($value, $max);

        $this->name = $name;
        $this->value = $value;
        $this->favored = (bool) $favored;
        $this->specialties = $specialties;
        $this->description = $description;
    }

    public static function factory($type, $name, $value, $favored = false, array $specialties = [], $description = false)
    {
        $class = sprintf('\Melindrea\Exalted\Character\%s', $type);

        return new $class($name, $value, $favored, $specialties, $description);
    }
}
