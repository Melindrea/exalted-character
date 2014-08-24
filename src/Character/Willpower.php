<?php
namespace Melindrea\Exalted\Character;

class Willpower extends SpiritTrait
{
    public function __construct($value)
    {
        parent::__construct('Willpower', $value, false, [], false, 10);
    }
}
