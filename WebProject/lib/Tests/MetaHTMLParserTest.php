<?php

namespace lib\Tests;

use lib\MetaHTML\MetaHTMLParser as Parser;
use modules\aalmunia\testing\Module1 as module;
use lib\Bootstrap\ClassAutoLoader as Loader;

require_once "/usr/share/php/PHPUnit/Framework.php";
include_once("../Bootstrap/ClassAutoLoader.php");
Loader::register();

class MetaHTMLParserTest extends \PHPUnit_Framework_TestCase
{
    protected $_object;
    
    protected function setUp()
    {        
        $this->_object = new Parser;        
    }
    
    public function testNode()
    {
        $strNode = "<modules:aalmunia:testing:Module1/>";
        $array = $this->_object->parseText($strNode, 0);
        $this->assertType("array", $array);
        $this->assertType("modules\\aalmunia\\testing\\Module1", $array[0]);
    }
}