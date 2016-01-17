<?php

namespace Pgit\Lib;

class Error {
	public function install() {
		$this->message('install');
	}

	private function message($code) {
		static $errors;

		if($errors === null) $errors = \Spyc::YAMLLoad(ROOT_DIR . '/config/errors.yml');
		echo $errors[$code] . "\n";
	}
}