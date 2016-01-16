<?php

namespace Pgit\Command;

class Init extends Base {
	public function run() {
		if(defined('INSTALL_PATH')) {
			echo sprintf("Reinitialized existing Git repository in %s\n", INSTALL_PATH);
		}
		else {
			define('INSTALL_PATH' , BASE_DIR . '/.pgit');
			$this->create();
		}
	}

	public function create() {
		$this->create_dir(INSTALL_PATH . '/objects');
	}

	public function create_dir($path) {
		echo ("create: " . $path. "\n");
		mkdir($path, 0700, TRUE);
	}
}