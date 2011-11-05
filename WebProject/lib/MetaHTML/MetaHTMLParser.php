<?php

namespace lib\MetaHTML;

class MetaHTMLParser
{
	//private $_nodePreg = "/<([a-zA-Z0-9_:=\"']*)>(.*?)<(\/[a-zA-Z0-9_:=\"']*)>/";
	private $_nodePreg = "/<([a-zA-Z0-9_:=\"']+)>(.*?)<(\/\\1)>/";
	
	public function __construct()
	{
		
	}

	public function parseNode($moduleNamespaced, $gridID, $moduleID)
	{		
		$module = new $moduleNamespaced;		
		$module->setUID($gridID."_".$moduleID);
		return $module;					
	}	
	
	public function parseText($text, $gridID)
	{
		$matches = array();
		$modulesReturn = array();
		preg_match_all($this->_nodePreg, $text, $matches, PREG_PATTERN_ORDER);		
		
		//print_r($matches);
		
		if(count($matches) > 1)
		{				
			for($i=0;$i<count($matches[1]);$i++)
			{
				$moduleDefinition = explode(" ", $matches[1][$i]);
				$moduleNamespaced = str_replace(":", "\\", $moduleDefinition[0]);				
				$modulesReturn[$i] = $this->parseNode($moduleNamespaced, $gridID, $i);
				$modulesReturn[$i]->setPreferences($matches[2][$i]);
				$modulesReturn[$i]->setMetaHTMLTag($moduleDefinition[0]);
			}			
			return $modulesReturn;
		}
		else
		{
			return null;
		}
	}		
}
