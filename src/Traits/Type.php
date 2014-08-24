<?php
namespace Melindrea\Exalted\Traits;

trait Type
{
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
