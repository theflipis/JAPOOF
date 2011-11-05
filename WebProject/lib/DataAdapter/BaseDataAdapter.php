<?php

namespace lib\DataAdapter;
use lib\Interfaces\ICRUD as ICRUD;

class BaseDataAdapter implements ICRUD
{
	public function connect(){}
	public function disconnect(){}
	public function create(){}
	public function read(){}
	public function update(){}
	public function delete(){}
}
