<?php
// in deze class mag alleen data uit de database gehaald worden en in variabelen/array's doorgegeven worden.
// representatie van de data zit in een aparte laag.

class Database { // implements Singleton

	public $connection;
	public $database;
	public $host;
	public $user;
	public $query_time;
	public $row_time;
	
	public $total_nr_queries;
	public $total_query_time;
	public $total_row_time;

	public $character_set;
	public $version;
	
	public static function instance() {
		static $instance = null;
		
		if($instance === null)
			$instance = new Database();
		
		return $instance;
	}
	
	public function Database() {
	
		//$this->backup($user,$password,$database);
		require_once DOC_ROOT.CONFIG_DIR."database_login.php";
	
		$this->database = $db_database;
		$this->host = $db_host;
		$this->user = $db_user;

		$this->query_time=0;
		$this->row_time=0;

		$this->total_nr_queries=0;
		$this->total_query_time=0;
		$this->total_row_time=0;

		$this->connection = mysql_connect($db_host, $db_user, $db_password, true, MYSQL_CLIENT_COMPRESS);
		mysql_select_db($db_database);
		mysql_set_charset('utf8', $this->connection);
		
		// character set en versie bepalen		
		$this->character_set	= mysql_client_encoding($this->connection); 
		$this->version			= mysql_get_server_info($this->connection);
	}

	public function query($query) {
	
		$time_start = getmicrotime();
		
		if(!($result = mysql_query($query,$this->connection))) {
		
//			die($user->hasRightByName('view_admin') ? $query."<br /><br />".mysql_error()."<br /><br /><pre>".htmlentities(print_r(debug_backtrace(), true), ENT_QUOTES, CHARSET)."</pre>" : "");
			throw new Exception($query."\n\n".mysql_error());
		}
		
		$time_end = getmicrotime();
		
		$this->total_nr_queries ++;
		$this->total_query_time += $time_end - $time_start;
		$this->query_time = $time_end - $time_start;
		
		return $result;
	}

	public function row($result) {

		$time_start = getmicrotime();
		$row = mysql_fetch_assoc($result);
		$time_end = getmicrotime();
		$this->total_row_time += $time_end - $time_start;
		$this->row_time = $time_end - $time_start;
	
		return $row;
	}
	
	public function fetchObject($result, $class_name = 'stdClass', $params = null) {
	
		if($params === null) {
			return mysql_fetch_object($result, $class_name);
		} else {
			return mysql_fetch_object($result, $class_name, $params);
		}
	}
	
	public function numRows($result) {
		return mysql_num_rows($result);
	}
	
	public function hasRows($result) {
		return $this->numRows($result) > 0;
	}
	
	public function insertId() {
		return mysql_insert_id($this->connection);
	}
	
	public function affectedRows() {
		return mysql_affected_rows($this->connection);
	}
	
	public function dataSeek($result,$record) {
		mysql_data_seek($result,$record);
	}
	
	public function getTablePrimaryKey($table) {
  		$keys = array();

  		$query = sprintf("SHOW KEYS FROM `%s`", $table);
  		$result = mysql_query($query) or die($query."<br /><br />".mysql_error());

  		while ($row = mysql_fetch_assoc($result)) {
   			if ($row['Key_name'] == 'PRIMARY') $keys[$row['Seq_in_index'] - 1] = $row['Column_name'];
  		}

 	 	return $keys;
	}

	public function getTableInformation($table) {
		static $table_info = array();
	
  		$information = array(
			"auto"    => "",
			"primary" => array(),
			"fields"  => array()
   		);

		if (!isset($table_info[$table])) { // First-time retrieval: retrieve and cache
			$information['primary'] = $this->GetTablePrimaryKey($table);
	
			$result = mysql_query("DESC `$table`") or die($query."<br /><br />".mysql_error());
			while ($field = mysql_fetch_assoc($result)) {
				$information['fields'][$field['Field']] = $field;
				if ($field['Extra'] == "auto_increment") $information['auto'] = $field['Field'];
			}
			$table_info[$table] = $information;
		} else { // Information is already cached
			$information = $table_info[$table];
		}
		
  		return $information;
	}
	
	public function getInsertAutoIncrementValue () {
		return  $this->insertId();
	}
	
	public static function escapeString($string) {
		
		return mysql_real_escape_string($string);
	}
	
	public function Num_rows($result) { // deprecated
		trigger_error('Num_rows function deprecated', E_USER_WARNING);
		return $this->numRows($result);
	}
	
	public function Insert_id() { // deprecated
		trigger_error('Insert_id function deprecated', E_USER_WARNING);
		return $this->insertId();
	}
	
	public function Affected_rows() { // deprecated
		trigger_error('Affected_rows function deprecated', E_USER_WARNING);
		return $this->affectedRows();
	}
	
	public function Data_seek($result, $record) { // deprecated
		trigger_error('Data_seek function deprecated', E_USER_WARNING);
		return $this->dataSeek($result, $record);
	}
	
	public function Escape_string($string) { // deprecated
		trigger_error('Escape_string function deprecated', E_USER_WARNING);
		return $this->escapeString($string);
	}
}

class Mysql implements Singleton {

	private $connection;

	public $last_query_time;
	public $total_query_time;
	public $nr_queries;
	
	public $slow_query;
	public $slow_time = 0;
	
	public function __construct() {
	
		$this->connection = Database::instance();

		if($error = mysql_error())
			trigger_error('failed connection to database '.$hostname.' / '.$database.' with error '.$error, E_USER_ERROR);
			
		$this->last_query_time	= 0;
		$this->total_query_time	= 0;
		$this->nr_queries		= 0;
	}
	
	public static function instance() {
	
		static $instance = null;
		
		if($instance === null)
			$instance = new self();
		
		return $instance;
	}
	
	public function query($query) {
	
		$time	= getmicrotime();
		$result	= $this->connection->query($query);	
		
		if($error = mysql_error())
			trigger_error("failed query to database with query \n<br /><pre>".$query."</pre>\n<br /> and error ".$error, E_USER_ERROR);

		$this->last_query_time	 = getmicrotime() - $time;
		$this->total_query_time	+= $this->last_query_time;
		$this->nr_queries		++;
		
		if($this->last_query_time > $this->slow_time) {
			$this->slow_time  = $this->last_query_time;
			$this->slow_query = $query;
		}
		
		return $result;
	}
	
	public static function escape($string) {
	
		return Database::escapeString($string);
	}
	
	public function fetch_all_objects($query, $class_name = 'stdClass', $key = null, $params = null) {
	
		$objects = array();
		$result = $this->query($query);
		while($object = ($params === null ? $this->connection->fetchObject($result, $class_name) : $this->connection->fetchObject($result, $class_name, $params))) {
			if($key === null) {
				$objects[] = $object;
			} else {
				$objects[$object->$key] = $object;
			}
		}
		return $objects;
	}
	
	public function fetch_single_object($query, $class_name = 'stdClass', $params = null, $return = null) {
		
		$result = $this->query($query);
		if($object = ($params === null ? $this->connection->fetchObject($result, $class_name) : $this->connection->fetchObject($result, $class_name, $params))) {
			return $object;
		} else {
			return $return;
		}
	}
	
	public function fetch_all_values($query) {
	
		$values = array();
		$result = $this->query($query);
		while($row = $this->connection->row($result)) {
			$values[] = array_pop($row);
		}
		return $values;
	}
	
	public function fetch_single_value($query, $return = 0) {
	
		$result = $this->query($query);
	
		return (($row = $this->connection->row($result)) ? array_pop($row) : $return);
	}
}

?>