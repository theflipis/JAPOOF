<?php

namespace lib\XML;

abstract class AbstractXMLParser
{
	protected $_xmlFragments;
	
	protected function __construct()
	{
		
	}
	
	public abstract function parse();
	public abstract function read();
}
