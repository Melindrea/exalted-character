<?php
namespace Melindrea\Exalted;

class Character
{
    protected $data = array();

    public function __get($item)
    {
        if (isset($this->data[$item])) {
            return $this->data[$item];
        }

        return null;
    }

    public function __set($item, $value)
    {
        $this->data[$item] = $value;
    }

    public function set($item, $value)
    {
        $this->__set($item, $value);
        return $this;
    }

    public function values($items)
    {
        foreach ($items as $item => $value) {
            $this->__set($item, $value);
        }

        return $this;
    }

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
