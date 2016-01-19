<?php

namespace Pgit\Lib;

class Command {
	const SHORTOPTS = "p";
	const LONGOPTS = [
		"shared:"
	];

	function run($argv) {
		define('BASE_DIR', getcwd());
		$install_path = \Pgit\Lib\Find::install_path();
		if(strlen($install_path) > 0) {
			define('INSTALL_PATH', $install_path);
			define('WORK_DIR', dirname($install_path));
		}

		$commands = array_slice($argv, 1);

		if(count($commands) == 0) {
			echo Man::get('help') . "\n";
			exit;
		}

		$name = $commands[0];

		
		$class_name = 'Pgit\\Command\\' . camelize($name);

		$filename = \Pgit\Autoloader::load_class_path($class_name);

		if(!file_exists($filename)) {
			$message = sprintf("pgit: '%s' is not a git command. See 'pgit --help'\n", $name);
			echo $message;
			exit;
		}

		$options = getopt(self::SHORTOPTS, self::LONGOPTS);
		
		$instance = new $class_name($options);
		$instance->run();
	}
}

