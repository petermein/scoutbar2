<?php

interface Singleton {

	public static function instance();
}

interface APISerializable {

	public function getAPIData();
}



?>