<?php

namespace Pgit\Lib;

class Blob {
	function create($add_filename) {
		$body = file_get_contents(WORK_DIR . '/' . $add_filename);
		$blob = gzcompress('blob 0' . $body, 9);
		$sha1 = sha1($blob);

		$filename = INSTALL_PATH . '/objects/' . substr_replace($sha1, '/', 2, 0);

		if(file_exists($filename)) {
			return true;
		}

		mkdir(dirname($filename), 0777, TRUE);
		file_put_contents($filename, $blob);
	}
}