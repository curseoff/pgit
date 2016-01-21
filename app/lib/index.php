<?php

namespace Pgit\Lib;

class Index {
	function add($add_filename, $sha1, $filesize) {
		$index_path = (INSTALL_PATH . '/index');

		$body = sprintf("%s %s %s\n", $add_filename, $filesize, $sha1);
		file_put_contents($index_path, $body, FILE_APPEND);
	}
}