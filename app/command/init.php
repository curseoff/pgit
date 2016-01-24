<?php

namespace Pgit\Command;

class Init extends \Pgit\Lib\Base {
	public function run() {
		if(defined('INSTALL_PATH')) {
			echo sprintf("Reinitialized existing Git repository in %s\n", INSTALL_PATH);
		}
		else {
			define('INSTALL_PATH' , BASE_DIR . '/.pgit');
			echo sprintf("Initialized empty Pgit repository in %s/\n", INSTALL_PATH);

			$this->create();
		}
	}

	public function create() {
		chdir(ROOT_DIR);
		dir_copy(ROOT_DIR . '/repository', INSTALL_PATH);
	}

	public function create_dir($path) {
		echo ("create: " . $path. "\n");
		mkdir($path, 0700, TRUE);
	}

	protected function options() {
		
	}


}