<?php

namespace Pgit\Lib;

class Find {
	public static function install_path() {
		return self::find_install_path(BASE_DIR);
	}

	public static function find_install_path($base_dir) {
		if($base_dir === '/') $base_dir = '';
		$install_path = $base_dir . '/.pgit';

		if(file_exists($install_path)) {
			return $install_path;
		} else if($base_dir === '') {
			return null;
		} else {
			return self::find_install_path(dirname($base_dir));
		}
	}
}