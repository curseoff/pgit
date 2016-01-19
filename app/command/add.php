<?php

namespace Pgit\Command;

class Add extends \Pgit\Lib\Base {
	public function run() {
		$this->error->repository_exists();

		pp(1);
	}
}