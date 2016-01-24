<?php

namespace Pgit\Lib;

abstract class Base {
	protected $options;
	protected $error;
	protected $commands;

	abstract protected function set_options();
 
	function __construct() {
		$this->error = new \Pgit\Lib\Error();
		$this->set_options();
	}
}