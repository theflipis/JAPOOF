<?php

namespace lib\Module;
use lib\DataAdapter\BaseDataDefinition as BaseDataDefinition;

class AbstractModule
{
	protected $_aPreferences;
	protected $_uid;
	protected $_metaHTMLTag;
	protected $_containerDiv;
	protected $_finalCode;
	
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
		$this->_containerDiv["OPEN"] = "<div id=\"".$this->_uid."\">";
		$this->_containerDiv["CLOSE"] = "</div>";
	}
	
	public function setMetaHTMLTag($open)
	{
		$this->_metaHTMLTag = $open;
		$this->_aPreferences["METATAGS"] = $this->_metaHTMLTag;
	}
	
	protected function preRender()
	{
		$this->_finalCode["JS"] = $this->jsReloadSnippet();
		$this->_finalCode["HTML"] = $this->_containerDiv["OPEN"];
		$this->_finalCode["HTML"] .= "[CHILD_CODE_GOES_HERE]";
		$this->_finalCode["HTML"] .= $this->_containerDiv["CLOSE"];		
	}
	
	protected function render($what)
	{
		$this->preRender();
		$this->_finalCode["HTML"] = str_replace("[CHILD_CODE_GOES_HERE]", $what, $this->_finalCode["HTML"]);		
		echo $this->_finalCode["JS"];
		echo $this->_finalCode["HTML"];		
	}
	
	protected function renderHTML($what)
	{
		$this->preRender();
		$this->_finalCode["HTML"] = str_replace("[CHILD_CODE_GOES_HERE]", $what, $this->_finalCode["HTML"]);		
		echo $this->_finalCode["HTML"];
	}
	
	public function jsReloadSnippet()
	{
		$this->_aPreferences["RELOAD"] = true;
		$jsFunction = "<script>";
		$jsFunction .= "function reloadModule_".$this->_uid."()\n";
		$jsFunction .= "{\n";		
		$jsFunction .= "var preferences = ".json_encode($this->_aPreferences, JSON_FORCE_OBJECT).";\n";
		$jsFunction .= "var realData = jQuery.param(preferences);\n";
		$jsFunction .= "var divUpdate = \"".$this->_uid."\";\n";
		$jsFunction .= "alert(realData);\n";
		$jsFunction .= "$.ajax({\n";
		$jsFunction .= "url: \"index.php\",\n";
		$jsFunction .= "data: realData,\n";
		$jsFunction .= "dataType: \"html\",\n";
		$jsFunction .= "success: function(data)\n";
		$jsFunction .= "{ \n";
		//IF DEBUG
		$jsFunction .= "var allData = data + \"<br/><a href='javascript:reloadModule_".$this->_uid."();'>CLICK TO RELOAD MODULE</a><br/>\";\n";
		$jsFunction .= "$(\"#\" + divUpdate).html(allData);\n";
		$jsFunction .= "}\n";
		$jsFunction .= "});\n";
		$jsFunction .= "}\n";
		$jsFunction .= "</script>";
		$this->_aPreferences["RELOAD"] = false;
		return $jsFunction;
	}
}
