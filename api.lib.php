<?php

function xml_recursive_add_child(SimpleXMLElement &$xml, $key, $value) {

	if(is_array($value)) {

		$child = $xml->addChild($key);

		foreach($value as $c_key => $c_value)
			xml_recursive_add_child($child, $c_key, $c_value);
	
	} else {
	
		$xml->addChild($key, xmlcharacters($value));
	}		
}

class API {

	public $id;
	public $name;
	public $script_file;
	
	public static function byName($name) {
	
		$query = "
			SELECT
				*
			FROM
				`tbl_api_scripts`
			WHERE
				name='".Mysql::escape($name)."'
			LIMIT 1
		";
		
		return Mysql::instance()->fetch_single_object($query, __CLASS__);
	}
	
	public function supports($format) {
	
		return in_array($format, array('xml', 'json', 'jsonp', 'csv'));
	}
	
	public static function serialize_array($array = null, $type) {
		
		switch(CurrentAPI::format()) {
		
			case 'jsonp':
			
				header('Content-type: text/javascript');
				
				echo $_GET['callback'].'('.json_encode($array).');';

				break;

			case 'json':
			
				header('Content-type: application/json');
				
				echo json_encode($array);

				break;
			
			/*case 'xml':
				
				header("Content-type: text/xml");
				$xml = simplexml_load_string("<?xml version='1.0' encoding='".ENCODING."' ?>\n<".$type.">\n</".$type.">", null, LIBXML_NOENT);
								
				foreach($array as $key => $value)
					xml_recursive_add_child($xml, $key, $value);
					
				echo $xml->asXML();

				break;
			
			case 'csv':
			
				header("Content-type: text/csv");
				$first = true;
				
				foreach($array as $key => $value)
					echo $key.";";

				echo PHP_EOL;

				foreach($array as $value)
					echo $value.";";

				echo PHP_EOL;

				break;*/
		}
		
		exit;
	}

	public static function serialize_single_object(APIserializable $object = null, $type) {
	
		switch(CurrentAPI::format()) {
		
			case 'jsonp':
			
				header('Content-type: text/javascript');
				
				echo $_GET['callback'].'('.json_encode($object->getAPIdata()).');';

				break;

			case 'json':
			
				header('Content-type: application/json');
				
				echo json_encode($object->getAPIdata());

				break;
			
			case 'xml':
				
				header("Content-type: text/xml");
				$xml = simplexml_load_string("<?xml version='1.0' encoding='".ENCODING."' ?>\n<".$type.">\n</".$type.">", null, LIBXML_NOENT);
								
				foreach($object->getAPIdata() as $key => $value)
					xml_recursive_add_child($xml, $key, $value);
					
				echo $xml->asXML();

				break;
			
			case 'csv':
			
				header("Content-type: text/csv");
				$first = true;
				
				foreach($object->getAPIdata() as $key => $value)
					echo $key.";";

				echo PHP_EOL;

				foreach($data as $value)
					echo $value.";";

				echo PHP_EOL;

				break;
		}
		
		exit;
	}
	
	public static function serialize_all_objects(array $objects, $type) {
	
		foreach($objects as $object) {

			if(!($object instanceof APIserializable))
				json_error(500, 'Internal Server Error', 'Internal Server Error', 'An object you requested does not implement the required API method.');
		}

		switch(CurrentAPI::format()) {
		
			case 'jsonp':
			
				header('Content-type: text/javascript');
				$data = array();
				
				foreach($objects as $object)
					$data[] = $object->getAPIdata();
				
				echo $_GET['callback'].'('.json_encode($data).');';

				break;

			case 'json':
			
				header('Content-type: application/json');
				$data = array();
				
				foreach($objects as $object)
					$data[] = $object->getAPIdata();
					
				echo json_encode($data);
				break;
			
			case 'xml':
			
				header("Content-type: text/xml");
				$xml = simplexml_load_string("<?xml version='1.0' encoding='".ENCODING."' ?>\n<".$type."s>\n</".$type."s>", null, LIBXML_NOENT);
				
				foreach($objects as $object) {

					$child = $xml->addChild($type);
				
					foreach($object->getAPIdata() as $key => $value)
						xml_recursive_add_child($child, $key, $value);
						
				}

				echo $xml->asXML();
				break;
			
			case 'csv':
			
				header("Content-type: text/csv");
				$first = true;
				
				foreach($objects as $object) {
				
					$data = $object->getAPIdata();

					if($first) {
					
						foreach($data as $key => $value)
							echo $key.";";
						
						echo PHP_EOL;					
						$first = false;
					}
					
					foreach($data as $value)
						echo $value.";";
					
					echo PHP_EOL;
				}
				break;
		}
		
		exit;
	}
}

class CurrentApi extends API implements Singleton {

	public $format;

	public static function instance() {
	
		static $instance = null;
		
		if($instance === null)
			$instance = new self();
		
		return $instance;
	}
	
	public static function id() {
	
		return self::instance()->id;
	}
	
	public static function format() {
	
		return self::instance()->format;
	}
	
	public function __construct() {
	
		if(!isset($_SERVER['PATH_INFO']))
			json_error(404, 'Not Found', 'Not Found', 'No API was specified.');

		$path = explode('/',$_SERVER['PATH_INFO']);		
		
		@list(
			$name,
			$this->format
		) = explode('.', array_pop($path));
		
		if(!($api = Api::byName($name)))
			json_error(404, 'Not Found', 'Not Found', 'The selected API does not exist.');
		
		if(!$api->supports($this->format))
			json_error(415, 'Unsupported Media Type', 'Not Supported', 'The API does not support the selected format.');
		
		if($this->format == 'jsonp' and (!isset($_GET['callback']) or empty($_GET['callback']) or is_numeric($_GET['callback'][0])))
			json_error(412, 'Precondition Failed', 'Callback Parameter Missing or Incorrect', 'The API you called was unable to reply with a valid callback because you did not specify one.');

		$this->id			= $api->id;
		$this->name			= $api->name;
		$this->script_file	= $api->script_file;
	}
	
	public function show() {
		if(!file_exists(DOC_ROOT.MODULE_API_DIR.$this->script_file))
			json_error(500, 'Internal Server Error', 'Internal Server Error', 'The specific API handler was not found');
	
		$limit  = (isset($_GET['limit']) ? $_GET['limit'] : null);
		$start  = (isset($_GET['start']) ? $_GET['start'] : null);
		$order  = (isset($_GET['order'])  and is_array($_GET['order']))  ? $_GET['order']  : array();
		$filter = (isset($_GET['filter']) and is_array($_GET['filter'])) ? $_GET['filter'] : array();
		
		$this->logCall();

		require DOC_ROOT.MODULE_API_DIR.$this->script_file;
		
		// if you are here, the api was not handled
		json_error(412, 'Precondition Failed', 'Parameter Missing or Incorrect', 'The API you called was unable to handle your request without proper parameters specified.');
	}
	
	public function logCall() {
	
		if(array_key_exists('PHP_AUTH_PW', $_SERVER))
			$_SERVER['PHP_AUTH_PW'] = '*****';
	
		Mysql::instance()->query("
			INSERT INTO
				`tbl_api_log` (
					ip,
					api_id,
					format,
					`headers`,
					`server`,
					`get`,
					`post`,
					`response`,
					user_id,
					auth
				)
			VALUES
				(
					INET_ATON('".Mysql::escape($_SERVER['REMOTE_ADDR'])."'),
					 ".$this->id.",
					'".$this->format."',
					'".Mysql::escape(print_r(apache_request_headers(), true))."',
					'".Mysql::escape(print_r($_SERVER, true))."',
					'".Mysql::escape(print_r($_GET, true))."',
					'".Mysql::escape(print_r($_POST, true))."',
					'".Mysql::escape(ob_get_contents())."',
					 ".RequestVerifier::id().",
					'".RequestVerifier::method()."'
				)
		");
	}
}

class APIToken implements APIserializable {

	const default_ttl  = 7200; 
	const key          = 'redRecH?yan!ja~UPeke-3s2d2uzawre'; 

	public $token; 
	public $auth_id;

	public function __construct($ip, $auth_id, $ttl = self::default_ttl) {

		$this->token   = self::generateToken($ip, $auth_id, $ttl);
		$this->auth_id = $auth_id; 
	} 

	public static function generateToken($ip, $auth_id, $ttl = self::default_ttl) {

		$timeValid = time() + $ttl; 

		$prefix  = self::getRandomHexString(6); 
		$timeHex = sprintf('%08x', $timeValid); 

		$hmac    = self::getTokenHmac($prefix, $timeValid, $ip, $auth_id); 

		return base64_encode(pack('H*', $prefix.$timeHex.$hmac)); 
	} 

	public static function getTokenHmac($prefix, $time, $ip, $auth_id) { 

		$data = array($time, $ip, $auth_id, REALM); 

		$key  = $prefix.self::key; 
		$data = implode('|', $data); 
		$blocksize = 64; 

		if (strlen($key) > $blocksize) 
			$key = sha1($key, true); 

		$key  = str_pad($key, $blocksize, chr(0x00)); 
		$ipad = str_repeat(chr(0x36),$blocksize); 
		$opad = str_repeat(chr(0x5c),$blocksize); 

		return sha1(($key ^ $opad).sha1(($key ^ $ipad).$data, true)); 
	} 

	private static function getRandomHexString($byteCount) { 

		$byteString = ''; 

		while($byteCount--) 
			$byteString .= sprintf('%02x', mt_rand(0, 255)); 

		return $byteString; 
	}
	
	public function getAPIdata() {
	
		return array(
			'token'		=> $this->token,
			'auth_id'	=> (int)$this->auth_id,
			'ip'		=> $_SERVER['REMOTE_ADDR']
		);
	}
}

?>