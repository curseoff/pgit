<?php

namespace Pgit\Lib;

class Color {
	const colors = [
		'red' => 31,
		'green' => 32,
	];
	public static function text($color, $message) {
		return sprintf("\e[%dm%s\e[m", self::colors[$color], $message);
	}
}