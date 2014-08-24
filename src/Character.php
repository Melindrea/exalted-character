<?php
namespace Melindrea\Exalted;

class Character extends Base
{
    use \Melindrea\Exalted\Traits\Type;

    public static function factory($type = null)
    {
        if ($type) {
            $class = sprintf('\Melindrea\Exalted\Character\%s', $type);
        } else {
            $class = '\Melindrea\Exalted\Character';
        }
        return new $class();
    }
}
