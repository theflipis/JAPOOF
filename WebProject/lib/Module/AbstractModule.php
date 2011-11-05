<?php

//@TODO: No devolver siempre la capa contenedora, sino se van creando como hijas una de otra en cada recarga

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
		echo "IM HERE";
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
		$this->_finalCode["HTML"] = $this->_containerDiv["OPEN"];
		$this->_finalCode["HTML"] .= "[CHILD_CODE_GOES_HERE]";
		$this->_finalCode["HTML"] .= $this->_containerDiv["CLOSE"];		
	}
	
	protected function render($what)
	{
		//@TODO: Esto aqui no, es para probar		
		$this->preRender();
		$this->_finalCode["HTML"] = str_replace("[CHILD_CODE_GOES_HERE]", $what, $this->_finalCode["HTML"]);
		$this->_finalCode["HTML"] .= "<script type=\"text/javascript\">var prefs_".$this->_uid." = ".json_encode($this->_aPreferences, JSON_FORCE_OBJECT)."</script>";
		echo $this->_finalCode["HTML"];		
	}	
}
