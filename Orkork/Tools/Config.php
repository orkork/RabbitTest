<?php

namespace Orkork\Tools;

class Config implements \Iterator
{
    private $_config = array();
    private $_readOnly;

    public function __construct($config, $readOnly = true)
    {
        if(is_array($config)) {
            $this->_config = $config;
        }

        $this->_readOnly = $readOnly;
    }

    public function __get($name)
    {
        $value = null;

        if(array_key_exists($name, $this->_config)) {
            $value = $this->_config[$name];
        }

        return $value === null || is_array($value) ? new Config($value, $this->_readOnly) : $value;
    }

    public function __set($name, $value)
    {
        if($this->_readOnly) {
            throw new Exception\AccessError('Trying to write property "' . $name . '" to a read-only object', 11);
        }

        $this->_config[$name] = $value;

        return $this;
    }

    public function __isset($name)
    {
        return !empty($this->_config[$name]);
        // return array_key_exists($name, $this->_config);
    }

    public function __toString()
    {
        return '';
    }

    public function toArray()
    {
        return $this->_config;
    }

    public function rewind() {
        reset($this->_config);
    }

    public function current() {
        
        $current = current($this->_config);

        if(is_array($current)) {
            $current = new Config($current, $this->_readOnly);
        }

        return $current;
    }

    public function key() {
        return key($this->_config);
    }

    public function next() {
        return next($this->_config);
    }

    public function valid() {
        return ($this->current() !== false);
    }
}