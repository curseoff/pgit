<?php

namespace Pgit\Command;

class Status extends \Pgit\Lib\Base {
    public function run() {
        $this->error->repository_exists();

        $file = new \Pgit\Lib\File();
        $working_files = $file->working_files();

        foreach($working_files as $index => $working_file) {
            echo \Pgit\Lib\Color::red(sprintf("    %s: %s\n", "new file", $working_file));
        }
    }
}