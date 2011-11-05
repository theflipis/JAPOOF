<?php

namespace lib\FrontController;
use lib\Interfaces\ICacheable as ICache;
use lib\Module\AbstractModule as Module;

class Grid extends AbstractFrontController implements ICache
{
	private $_aModules = null;	
	private $_dataAdapter = null;
	private $_aWhoGetsWhat = null;
	
	public function __construct($aParamModules)
	{
		parent::__construct($aParamModules);		
	}
	
	public function addModule(Module $module)
	{
		
	}
	
	public function deleteModule(Module $module)
	{
		
	}
	
	public function setDataAdapter($dataAdapter)
	{
		
	}
	
	public function readCache()
	{
		
	}
	
	public function writeCache()
	{
		
	}
	
	public function setCacheDataAdapter()
	{
		
	}
	
	public function setCacheLifetime()
	{
		
	}
	
	private function extractDataForModules()
	{
		
	}
}
