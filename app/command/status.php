<?php

namespace Pgit\Command;

class Status extends \Pgit\Lib\Base {
    public function run() {
        $this->error->repository_exists();

        $file = new \Pgit\Lib\File();
        $working_files = $file->working_files();

        $index = new \Pgit\Lib\Index();
        $index_files = $index->get();

        foreach($working_files as $index => $working_file) {
        	$working_file = trim($working_file);

        	if(isset($index_files[$working_file])) {
        		$color = 'green';
        		$filetype = 'modified';
        	}
        	else {
        		$color = 'red';
        		$filetype = 'new file';
        	}

            echo \Pgit\Lib\Color::text($color, sprintf("    %s: %s\n", $filetype, $working_file));
        }
    }
}