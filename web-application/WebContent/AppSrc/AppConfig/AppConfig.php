<?php

/**
 * App configuration file
 *
 * @author rolind.roy
 *
 */
 
class AppConfig
{

    private static $_config = NULL;
    private $_configArr;
    private $_pathDelimiter = ".";

    public function __construct()
    {

    }

    public static function load($filepath)
    {
        if (self::$_config === NULL)
        {
            self::$_config = new self();
            self::$_config->setConfig($filepath);
        }
    }

    public static function config($key)
    {

        return (self::$_config !== NULL)? self::$_config->getConfig($key) : NULL;
    }

    private function setConfig($config)
    {
        $this->_configArr = include $config;
    }

    public function getConfig($key)
    {
        $tmpdata = $this->_configArr;
        $path = explode($this->_pathDelimiter, $key);

        foreach ($path as $part)
        {
            if (isset($tmpdata[$part]))
            {
                $tmpdata = $tmpdata[$part];
            } else
            {
                return null;
            }
        }
        return $tmpdata;
    }
}
