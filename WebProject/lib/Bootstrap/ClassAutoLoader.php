<?php

namespace lib\Bootstrap;

/**
 * This class serves as autoloader for all remaining classes. It has to be
 * included in the 'dirty' way in the index.php that serves as front controller
 */
class ClassAutoLoader
{
    static $_appRoot = "/home/alejandro/JAPOOF/WebProject/";    
    
    /**
     * Loads a class by its namespace
     * @param string $className The namespaced name of the class
     * @TODO: Don't use require_once if possible
     */
    static function loadClass($className)
    {
        $newClassName = str_replace("\\", "/", $className).".php";
    	require_once(self::$_appRoot.$newClassName);
    }

    /**
     * Initializer for the autoloader
     */
    static function register()
    {
        spl_autoload_register(__CLASS__."::loadClass");
    }    
    
    static function unregister()
    {
        spl_autoload_unregister(__CLASS__.":loadClass");
    }  
    
}
