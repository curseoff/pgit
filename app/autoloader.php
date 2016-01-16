<?php

namespace Pgit;

class Autoloader {
	public static function load_class($class_name) {
		$pathes =  array_map('underscore', explode('\\', $class_name));
		$pathes[0] = 'app';
		$path = implode('/', $pathes);

		$filename = ROOT_DIR . '/' . $path . '.php';
		if(file_exists($filename)) {
			require $filename;
			return true;
		}
	}
}

spl_autoload_register(__NAMESPACE__ . '\Autoloader::load_class');