<?php

namespace Pgit\Module;

trait Option {
	protected $options;
	protected $error;
	protected $commands;
 
	function initialize_options() {
		static $self;

		if($self === null) {
			$self = new self();
		}

		return $self;
	}
}