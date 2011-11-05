<?php

namespace lib\Colorizer;

/**
 * PHP code colorizer
 */
class PHPColorizer extends BaseColorizer
{
    /**
     * Construct
     * @return PHPColorizer
     */
	 public function __construct()
	 {
		 parent::__construct();
	 }

         /**
          * Implementation of the colorization method.
          * @method void colorize()
          * @return void
          */
	 public function colorize()
	 {
		 $div = array();
		 if($this->_divSurround !== null)
		 {
			 $div = $this->makeDivSurround();
		 } 
		 
		 for($i=0;$i<count($this->_aCodeFragments);$i++)
		 {
			 $this->_aCodeColorizedFragments[$i] = "<h2>".$this->_aCodeTitles[$i]."</h2>";
			 if($this->_divSurround["EVERY"] === true)
			 {				
				$this->_aCodeColorizedFragments[$i] .= $div["OPENTAG"].highlight_string($this->_aCodeFragments[$i], true).$div["CLOSETAG"];
			 }
			 else
			 {
				 $this->_aCodeColorizedFragments[$i] .= highlight_string($this->_aCodeFragments[$i], true);
			 }			 
		 }		 		
	 }
 }
