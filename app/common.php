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
	echo sprintf("%s:%s\n", $file, $line);
	print_r($body);
	echo "\n\n";
}