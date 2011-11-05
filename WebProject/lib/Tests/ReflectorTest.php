<?php

namespace lib\Tests;

use lib\Reflection\Reflector as Reflector;
use lib\Bootstrap\ClassAutoLoader as Loader;

require_once "/usr/share/php/PHPUnit/Framework.php";
include_once("../Bootstrap/ClassAutoLoader.php");
Loader::register();

class testSerialize
{
    private $_prop_1;
    private $_prop_2;
    private $_prop_3;

    protected $_prop_4;
    protected $_prop_5;
    protected $_prop_6;
    
    public function initData()
    {
        $this->_prop_1 = "cosa, mesa, casa";
        $this->_prop_2 = 9000;
        $this->_prop_3 = 0.7890;
    
        $this->_prop_4 = array("cosa", "mesa", "casa");
        $this->_prop_5 = array("cosa", 0, "mesa", 1, "casa", 2);
        $this->_prop_6 = array("test1" => "cosa", "test2" => "mesa");        
    }
    
    public function getData()
    {
        echo $this->_prop_1;        
    }
}

class objSerializator
{
    private $obj_1;
    private $obj_2;
    private $obj_3;
    
    private $_prop_1;
    private $_prop_2;
    private $_prop_3;

    protected $_prop_4;
    protected $_prop_5;
    protected $_prop_6;
    
    public function initData()
    {
        $this->obj_1 = new testSerialize();
        $this->obj_1->initData();
        $this->obj_2 = new testSerialize();
        $this->obj_2->initData();
        $this->obj_3 = new testSerialize();
        $this->obj_3->initData();
        
        $this->_prop_1 = "cosa, mesa, casa";
        $this->_prop_2 = 9000;
        $this->_prop_3 = 0.7890;
    
        $this->_prop_4 = array("cosa", "mesa", "casa");
        $this->_prop_5 = array("cosa", 0, "mesa", 1, "casa", 2);
        $this->_prop_6 = array("test1" => "cosa", "test2" => "mesa");        
    }    
}

class ReflectorTest extends \PHPUnit_Framework_TestCase
{
    protected $_object;
    
    protected function setUp()
    {
        //$this->_object = new Reflector();
    }
    
    public function testSimpleObjects()
    {
        $c1 = new objSerializator();
        $c1->initData();
        $jsoned = Reflector::serializeObject($c1, "");
        $c2 = new objSerializator();
        $c2->initData();
        Reflector::unserializeObject($c2, $jsoned);
        $this->assertEquals($c2, $c1);
        $this->assertEquals($c1, $c2);
    }
}