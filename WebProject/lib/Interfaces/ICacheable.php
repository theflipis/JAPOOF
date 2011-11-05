<?php

namespace lib\Interfaces;

interface ICacheable
{
	public function readCache();
	public function writeCache();
	public function setCacheDataAdapter();
	public function setCacheLifetime();	
}
