<?php

namespace lib\Module;
use lib\DataAdapter\BaseDataDefinition as BaseDataDefinition;

class AbstractModule
{
	protected $_aPreferences;
	protected $_uid;
	protected $_metaHTMLTag;
	
	protected function __construct()
	{
		
	}
	
	public function setPreferences($jsonData)
	{
		$tmpJSON = json_decode($jsonData, true);
		$tmpKeys = array_keys($tmpJSON);
		for($i=0;$i<count($tmpKeys);$i++)
		{			
			$this->_aPreferences[$tmpKeys[$i]] = $tmpJSON[$tmpKeys[$i]];
		}
	}
	
	public function setUID($uid)
	{
		$this->_uid = $uid;		
	}
	
	public function setMetaHTMLTag($open)
	{
		$this->_metaHTMLTag["OPEN"] = "<".$open.">";
		$this->_metaHTMLTag["CLOSE"] = "</".$open.">";
		//$this->_aPreferences["METATAGS"] = $this->_metaHTMLTag;
	}
	
	protected function render(){}
	
	public function jsReloadSnippet()
	{
		$this->_aPreferences["RELOAD"] = true;
		$jsFunction = "<script>";
		$jsFunction .= "function reloadModule_".$this->_uid."()\n";
		$jsFunction .= "{\n";		
		$jsFunction .= "var preferences = ".json_encode($this->_aPreferences, JSON_FORCE_OBJECT).";\n";
		$jsFunction .= "var realData = jQuery.param(preferences);\n";
		$jsFunction .= "alert(realData);\n";
		$jsFunction .= "$.ajax({\n";
		$jsFunction .= "url: \"index.php\",\n";
		$jsFunction .= "data: realData,\n";
		$jsFunction .= "dataType: \"html\",\n";
		$jsFunction .= "success: function(data)\n";
		$jsFunction .= "{ \n";
		$jsFunction .= "console.log(data);\n";
		$jsFunction .= "alert('im here...');\n";
		$jsFunction .= "}\n";
		$jsFunction .= "});\n";
		$jsFunction .= "}\n";
		$jsFunction .= "</script>";
		$this->_aPreferences["RELOAD"] = false;
		return $jsFunction;
	}
}
