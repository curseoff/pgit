<?php

namespace Pgit\Command;

use \Ulrichsg\Getopt\Getopt;
use \Ulrichsg\Getopt\Option;

class Add extends \Pgit\Lib\Base {
	public function run() {
		$this->error->repository_exists();

		$file = new \Pgit\Lib\File();
		$working_files = $file->working_files();

		$add_filename = isset($this->commands[1]) ? $this->commands[1] : null;
		if(!$add_filename) {
			echo "Nothing specified, nothing added.
Maybe you wanted to say 'pgit add .'?\n";
			exit;
		}

		if(!in_array($add_filename, $working_files)) {
			echo sprintf("fatal: pathspec '%s' did not match any files\n", $add_filename);
			exit;
		}

		$blob = new \Pgit\Lib\Blob();
		$sha1 = $blob->create($add_filename);
	}

	protected function set_options() {
		$getopt = new \Ulrichsg\Getopt\Getopt([
			new \Ulrichsg\Getopt\Option('p', 'patch', \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT)
		]);

		try {
    			$getopt->parse();
    			pp($getopt->getOptions());
    		} catch (UnexpectedValueException $e) {
    			echo "Error: ".$e->getMessage()."\n";
		      echo $getopt->getHelpText();
    			exit(1);
    		}
	}

}