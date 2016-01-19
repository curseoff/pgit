<?php

namespace Pgit\Command;

class Status extends \Pgit\Lib\Base {
    public function run() {
        $this->error->repository_exists();

        $files = $this->files();

        foreach($files as $index => $file) {
            echo sprintf("    \e[31m%s: %s\e[m\n", "new file", $file);
        }
    }

    public function files() {
        static $files;

        if($files === null) {
            $iterator = new \RecursiveDirectoryIterator(WORK_DIR);
            $iterator = new \RecursiveIteratorIterator($iterator);
            $length = strlen(WORK_DIR) + 1;
            $files = [];
            foreach ($iterator as $fileinfo) {
                if ($fileinfo->isFile()) {
                    $file =  $fileinfo->getPathname();

                    $files[] = substr($file, $length);
                }
            }
        }

        return $files;
    }
}