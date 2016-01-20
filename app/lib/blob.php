<?php

namespace Pgit\Lib;

class Blob {
	function create($add_filename) {
		$body = file_get_contents(WORK_DIR . '/' . $add_filename);
		$blob = gzcompress('blob 0' . $body, 9);
		$sha1 = sha1($blob);

		$filename = $this->filename($sha1);

		if(file_exists($filename)) {
			return true;
		}

		mkdir(dirname($filename), 0777, TRUE);
		file_put_contents($filename, $blob);
	}

	function get($sha1) {
		$filename = $this->filename($sha1);

		if(!file_exists($filename)) {
			echo "error";
			exit;
		}

		$body = gzuncompress(file_get_contents($filename));
		return preg_replace("#^(blob|commit|tag|tree) 0#", '', $body);
	}

	function filename($sha1) {
		return INSTALL_PATH . '/objects/' . substr_replace($sha1, '/', 2, 0);
	}
}