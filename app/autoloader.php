<?php

namespace Pgit;

class Autoloader {
	public static function load_class($class_name) {
		$filename = Autoloader::load_class_path($class_name);

		if(file_exists($filename)) {
			require $filename;
			return true;
		}
	}

	public static function load_class_path($class_name) {
		$pathes =  array_map('underscore', explode('\\', $class_name));
		$pathes[0] = 'app';
		$path = implode('/', $pathes);

		$filename = ROOT_DIR . '/' . $path . '.php';

		return $filename;
	}
}

spl_autoload_register(__NAMESPACE__ . '\Autoloader::load_class');