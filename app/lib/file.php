<?php

namespace Pgit\Lib;

class File {
    public function working_files() {
        static $working_files;

        if($working_files === null) {
            $iterator = new \RecursiveDirectoryIterator(WORK_DIR);
            $iterator = new \RecursiveIteratorIterator($iterator);
            $length = strlen(WORK_DIR) + 1;
            $working_files = [];
            foreach ($iterator as $fileinfo) {
                if ($fileinfo->isFile()) {
                    $working_file =  substr($fileinfo->getPathname(), $length);
                    if($this->ignore($working_file)) $working_files[] = $working_file;
                }
            }
        }

        return $working_files;
    }

    public function ignore($working_file) {
        if(preg_match("/^\.pgit/", $working_file)) {
            return false;
        }

        return true;
    }
}