<?php

class Fm {

	public static function checked($bool) {
		return	$bool ? ' checked="checked" ' : '';
	}

	public static function addClass($bool, $className) {
		return	$bool ? ' class="'.$className.'" ' : '';
	}

}
