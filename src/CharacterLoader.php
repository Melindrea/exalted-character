<?php
namespace Melindrea\Exalted;

class CharacterLoader
{
    public static function load(\Melindrea\Exalted\Interfaces\Loadable $loadable)
    {
        return $loadable->getCharacter();
    }
}
