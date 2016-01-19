<?php

namespace Pgit\Lib;

abstract class Base {
	protected $options;
	protected $error;
 
	function __construct($options) {
		$this->options = $options;
		$this->error = new \Pgit\Lib\Error();
	}
}