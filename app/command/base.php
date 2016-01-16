<?php

namespace Pgit\Command;

abstract class Base {
	protected $options;

	function __construct($options) {
		$this->options = $options;
	}
}