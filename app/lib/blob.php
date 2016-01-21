<?php

namespace Pgit\Lib;

class Blob {
	function create($add_filename) {
		$filepath = WORK_DIR . '/' . $add_filename;
		$sha1 = sha1_file($filepath);
		$filesize = filesize($filepath);
		
		$filename = $this->filename($sha1);

		$index = new \Pgit\Lib\Index();
		$index->add($add_filename, $sha1, $filesize);

		if(file_exists($filename)) {
			return $sha1;
		}

		$blob = gzcompress('blob ' . $filesize . ' 0/' . file_get_contents($filepath), 9);
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
		$body = preg_replace("#^(.+?0/)#", '', $body);

		return $body;
	}

	function filename($sha1) {
		return INSTALL_PATH . '/objects/' . substr_replace($sha1, '/', 2, 0);
	}
}