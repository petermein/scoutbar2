<?php

interface Singleton {

	public static function instance();
}

interface APISerializable {

	public function getAPIData();
}

interface Comparable  {

	public static function compare($a, $b);
}


?>