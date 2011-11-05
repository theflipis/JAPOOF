<?php

namespace lib\Interfaces;

interface ICRUD
{
	public function create();
	public function read();
	public function update();
	public function delete();
}
