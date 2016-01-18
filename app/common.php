<?php

function underscore($str)
{
	return ltrim(strtolower(preg_replace('/[A-Z]/', '_\0', $str)), '_');
}

function camelize($str)
{
	return (strtr(ucwords(strtr($str, ['_' => ' '])), [' ' => '']));
}

function pp($body) {
	$debug_backtrace = debug_backtrace();

	$debug = $debug_backtrace[0];

	$file = substr($debug['file'] , strlen(ROOT_DIR) + 1);
	$line = $debug['line'];
	ob_start();
	echo "------------------------------------------------------\n";
	echo date('Y-m-d H:i:s') . "\n";
	echo sprintf("%s:%s\n", $file, $line);
	echo "------------------------------------------------------\n";
	print_r($body);
	echo "\n\n";
	$output = ob_get_contents();
	ob_end_clean();
	file_put_contents(ROOT_DIR . '/logs/pp_log', $output, FILE_APPEND);

}

function dir_copy($dir_name, $new_dir)
{
	if (!is_dir($new_dir)) {
		mkdir($new_dir);
	}
 
	if (is_dir($dir_name)) {
		if ($dh = opendir($dir_name)) {
			while (($file = readdir($dh)) !== false) {
				if ($file == "." || $file == "..") {
					continue;
				}
				if (is_dir($dir_name . "/" . $file)) {
					dir_copy($dir_name . "/" . $file, $new_dir . "/" . $file);
				}
				else {
					copy($dir_name . "/" . $file, $new_dir . "/" . $file);
				}
			}
			closedir($dh);
		}
	}
	return true;
}