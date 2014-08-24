<?php
namespace Melindrea\Exalted;

class Base
{
    protected $data = [];

    public function __get($item)
    {
        if (isset($this->{$item})) {
            return $this->{$item};
        } elseif (isset($this->data[$item])) {
            return $this->data[$item];
        }

        return null;
    }

    public function __set($item, $value)
    {
        if (isset($this->{$item})) {
            $this->{$item} = $value;
        } else {
            $this->data[$item] = $value;
        }
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
}
