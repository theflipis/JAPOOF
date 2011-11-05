<?php

namespace lib\Colorizer;

class HTMLColorizer extends BaseColorizer
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function colorize()
	{
		//echo htmlspecialchars($this->_aCodeFragments[0]);
		$tmp = array();
		$this->tidycode($this->_aCodeFragments[0], $tmp);
		//echo implode("<hr/>", $tmp);		
	}
	
	private function tidyCode($code, &$fragments)
	{		
		$matches = array();
		$str = "/<.*>(.*)<\/.*>/";		
		preg_match($str, $code, $matches);
		$fragments[] = htmlspecialchars($matches);
		ob_start();
		print_r($matches);
		$echoed = htmlspecialchars(ob_get_contents());
		echo $echoed;
		/*if(count($matches) > 0)
		{
			for($i=0;$i<count($matches);$i++)
			{
				$this->tidycode($matches);
			}
		}
		return $fragments;*/
	}
}
