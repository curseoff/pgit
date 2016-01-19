<?php

namespace Pgit\Lib;

abstract class Base {
	protected $options;
	protected $error;
	protected $commands;
 
	function __construct($commands, $options) {
		$this->options = $options;
		$this->commands = $commands;
		$this->error = new \Pgit\Lib\Error();
	}
}