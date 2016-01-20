<?php

namespace Pgit\Command;

class CatFile extends \Pgit\Lib\Base {
	public function run() {
		$sha1 = $this->commands[1];

		$blob = new \Pgit\Lib\Blob();
		echo $blob->get($sha1);
	}
}