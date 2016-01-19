<?php

namespace Pgit\Lib;

class Error {
	public function repository_exists() {
		if(defined('INSTALL_PATH')) return true;
		$this->message('install');
	}

	public function command_exists($name) {
		$class_name = 'Pgit\\Command\\' . camelize($name);
		$filename = \Pgit\Autoloader::load_class_path($class_name);

		if(!file_exists($filename)) {
			$message = sprintf("pgit: '%s' is not a git command. See 'pgit --help'\n", $name);
			echo $message;
			exit;
		}
	}

	private function message($code) {
		static $errors;

		if($errors === null) $errors = \Spyc::YAMLLoad(ROOT_DIR . '/config/errors.yml');
		die($errors[$code] . "\n");
	}
}