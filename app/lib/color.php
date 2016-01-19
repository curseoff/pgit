<?php

namespace Pgit\Lib;

class Color {
	public static function red($message) {
		return sprintf("\e[31m%s\e[m", $message);
	}
}