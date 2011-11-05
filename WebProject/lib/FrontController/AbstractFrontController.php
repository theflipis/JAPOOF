<?php
namespace lib\FrontController;

class AbstractFrontController
{
	protected $_aModuleParams;
	
	public function __construct($aModuleParams)
	{
		$this->_aModuleParams = $aModuleParams;				
	}	
}
