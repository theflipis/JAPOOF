<?php
//@TODO: Capa de surround, toma de decisiones en clase base

namespace lib\Colorizer;

/**
 * This class serves as the base for all the code colorizers
 */
abstract class BaseColorizer
{
	protected $_aCodeFragments = null;
	protected $_aCodeColorizedFragments = null;
	protected $_aCodeTitles = null;
	protected $_divSurround = null;
	
	protected function __construct()
	{
        $this->_aCodeFragments = array();
        $this->_aCodeColorizedFragments = array();
        $this->_aCodeTitles = array();
	}

	/**
	 * This method adds a code chunk for the colorizer
	 * 
	 * @param string $code Source code to colorize
	 * 
	 * @return void
	 */
	public function setCode($code)
	{
        $this->_aCodeFragments[] = $code;
	}

        /**
         * Sets a title for a source code
         * @param string $title The title to use
         */
	public function setTitle($title)
	{
            $this->_aCodeTitles[] = $title;
	}
	
	protected abstract function colorize();	
	
	public function getCode($fragment)
	{		
            if($this->fragmentExists($fragment))
            {
                return $this->_aCodeColorizedFragments[$fragment];
            }
            else
            {
            	throw new Exception("lalalala"); //OutOfBoundsException();
            }
	}
	
	protected function fragmentExists($fragment)
	{		
		if(count($this->_aCodeFragments) >= $fragment)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getAllCode($separator)
	{
		return implode($separator, $this->_aCodeColorizedFragments);
	}
	
	public function setDivSurround($divClass, $divID = "")
	{
		$this->_divSurround = array();
		$this->_divSurround["CLASS"] = $divClass;
		if($divID != "")
		{
			$this->_divSurround["ID"] = $divID;			
		}		
	}
	
	public function surroundEachCode($bool)
	{
		$this->_divSurround["EVERY"] = ($bool === true) ? true : false;
	}
	
	protected function makeDivSurround()
	{
		if($this->_divSurround == null)
		{
			throw new Exception("NOT SURROUND DIV");
		}
		else
		{
			$html_op = "<div class=\"".$this->_divSurround["CLASS"]."\"";
			$html_op .= (array_key_exists("ID", $this->_divSurround)) ? "id=\"".$this->_divSurround["ID"]."\"" : "";
			$html_op .= ">";			
			$html_cl = "</div>";
			return array("OPENTAG" => $html_op, "CLOSETAG" => $html_cl);
		}
	}
}
