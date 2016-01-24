<?php

namespace Pgit\Lib;

use \GetOptionKit\OptionCollection;
use \GetOptionKit\OptionParser;
use \GetOptionKit\OptionPrinter\ConsoleOptionPrinter;
use \GetOptionKit\ContinuousOptionParser;

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

		$this->sub($argv);
	}

	function sub($argv) {
		$subcommands = [
			'init',
			'add',
		];

		$cmdspecsInit = new OptionCollection;
		$cmdspecsInit->add('f|foo:', 'option requires a value.' )->isa('String');

		$cmdspecsAdd = new OptionCollection;
		$cmdspecsAdd->add('f|foo:', 'option requires a value.' )->isa('String');

		$subcommandSpecs = array(
			'init' => $cmdspecsInit,
			'add' => $cmdspecsAdd,
		);

		$parser = new ContinuousOptionParser($cmdspecsAdd );
		$app_options = $parser->parse( $argv );

		while (! $parser->isEnd()) {
			if (@$subcommands[0] && $parser->getCurrentArgument() == $subcommands[0]) {
				$parser->advance();
				$subcommand = array_shift( $subcommands );
				$parser->setSpecs( $subcommandSpecs[$subcommand] );
				$subcommandOptions[ $subcommand ] = $parser->continueParse();
				pp($subcommandOptions);

			} else {
				$arguments[] = $parser->advance();
			#	pp($arguments);
			}
		}
	}
}

