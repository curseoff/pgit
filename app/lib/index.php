<?php

namespace Pgit\Lib;

class Index {
	const INDEX_PATH =  INSTALL_PATH . '/index';

	function add($add_filename, $sha1, $filesize) {
		$result = $this->get();
		
		$result[$add_filename] = [
			'filesize' => $filesize,
			'sha1' => $sha1,
		];

		$this->write($result);
	}

	function write($result) {
		$line = [];

		foreach($result as $filepath => $info) {
			$line[] = implode("\t", [$filepath, $info['filesize'], $info['sha1']]);
		}

		$body = implode("\n", $line);
		file_put_contents(self::INDEX_PATH, $body);
	}

	function get() {
		$result = [];
		if(!file_exists(self::INDEX_PATH)) {
			return $result;
		}

		$fpw = fopen(self::INDEX_PATH,'r');
		while ($line = fgets($fpw)) {
			$data = explode("\t", $line);

			list($filepath, $filesize, $sha1) = $data;

			$result[trim($filepath)] = [
				'filesize' => trim($filesize),
				'sha1' => trim($sha1),
			];
		}

		return $result;
	}
}