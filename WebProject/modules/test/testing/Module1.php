<?php

namespace modules\test\testing;
use lib\Module\AbstractModule as AbstractModule;

class Module1 extends AbstractModule
{
	public function __construct()
	{
		
	}
	
	public function render()
	{
		echo "i am new module 1";
	}
}
