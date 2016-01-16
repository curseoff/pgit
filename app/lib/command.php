<?php

namespace Pgit\Lib;

class Command {
	const SHORTOPTS = "p";
	const LONGOPTS = [
		"shared:"
	];

	function run($argv) {

		$commands = array_slice($argv, 1);

		if(count($commands) == 0) {
			echo Man::get('help') . "\n";
			exit;
		}

		$name = $commands[0];
		$command_name = $commands[0];
		$command_filepath = ROOT_DIR . '/commands/' . $command_name;

		$commands[0] = $command_filepath;

		if(!file_exists($command_filepath)) {
			$message = sprintf("pgit: '%s' is not a git command. See 'pgit --help'\n", $name);
			echo $message;
			exit();
		}

		$command = implode(' ', $commands);

		echo shell_exec($command);
	}

	function exec($argv) {
		define('BASE_DIR', getcwd());

		$install_path = \Pgit\Lib\Find::install_path();
		if(strlen($install_path) > 0) define('INSTALL_PATH', $install_path);

		$command = basename($argv[0]);

		$options = getopt(self::SHORTOPTS, self::LONGOPTS);

		$class_name = '\\Pgit\\Command\\' . camelize($command);
		
		$instance = new $class_name($options);
		$instance->run();
	}
}

