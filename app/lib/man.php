<?php

namespace Pgit\Lib;

class Man {
	public static function get($command) {
		return file_get_contents(ROOT_DIR . '/man/' . $command);
	}
}