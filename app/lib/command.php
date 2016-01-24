<?php

namespace Pgit\Lib;
use \Ulrichsg\Getopt\Getopt;
use \Ulrichsg\Getopt\Option;

class Command {
	const SHORTOPTS = "p";
	const LONGOPTS = [
		"shared:"
	];

	function main($argv) {
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

		$this->sub($commands);
	}

	function sub($commands) {
#\

		$getopt = new Getopt([
			new Option('p', 'patch', Getopt::REQUIRED_ARGUMENT)
		]);

		try {
    			$getopt->parse();
    			pp($getopt->getOptions());
    		#	pp($getopt->getHelpText());

    		} catch (UnexpectedValueException $e) {
    			echo "Error: ".$e->getMessage()."\n";
		      echo $getopt->getHelpText();
    			exit(1);
    		}

    		exit;
		$name = $commands[0];
		$error = new Error();
		$error->command_exists($name);

		$options = getopt(self::SHORTOPTS, self::LONGOPTS);
		
		$class_name = 'Pgit\\Command\\' . camelize(strtr($name, '-', '_'));

		$instance = new $class_name();
		$instance->run();
	}
}

