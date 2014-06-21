<?php
namespace Melindrea\Exalted;

class Character extends Base
{
    public static function factory($type = null)
    {
        if ($type) {
            $class = sprintf('\Melindrea\Exalted\Character\%s', $type);
        } else {
            $class = '\Melindrea\Exalted\Character';
        }
        return new $class();
    }

    public function type()
    {
        $className = get_class($this);

        if ($className == 'Melindrea\Exalted\Character') {
            return null;
        }
        $type = str_replace('Melindrea\\Exalted\\Character\\', '', $className);

        return $type;
    }
}
