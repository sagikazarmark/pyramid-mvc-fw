<?php
class MSSQLDatabase extends Database {

public $config;

public function __construct($registry, $conn = NULL) {

	$this->registry = $registry;

	if ($conn == NULL) { $conn = $registry->config->database['default_connection']; }
	
	$this->config = $registry->config->database[$conn];
	$this->config['link'] = FALSE;
	
	$this->config['link'] = $this->connect();
	$this->database();
}

public function connect($params = NULL) {	
	
	if ($params == NULL) { $params = $this->config; }	
	if ($params['persistent'] == true) {
		$link = mssql_pconnect($params['host'], $params['user'], $params['pass']);
	}
	else {
		$link = mssql_connect($params['host'], $params['user'], $params['pass']);
	}
	
	return $link;
}


public function database($params = NULL) {
	if ($params == NULL) { $params = $this->config; }
	
	$database = mssql_select_db($params['dbname'], $params['link']);	
	
	return $database;
}

public function exec($query, $params = NULL) {
	if ($params == NULL) { $params = $this->config; }
	
	$result = mssql_query($query, $params['link']);
	
	if (!$result) {
		
	}
	elseif (!is_resource($result)) {
		return true;
	}
	else {
		$return = new MSSQLResult($params['link']);
		$return->result = $result;
		return $return;
	}

}


public function disconnect($link = NULL) {
	if ($link == NULL) {$link = $this->config['link']; }
	
	if ($link and is_resource($link)) {
		return mssql_close($link);
	}
	else {
		return false;
	}
}

public function __destruct() {
	$this->disconnect();
}
}

class MSSQLResult extends Result {
	
	public function __construct($link){
		$this->link = $link;
		if (!is_resource($link)){
			throw new Exception ("MSSQL connection is not a valid resource.");
		}
	}

	public function num_rows() {
		return mssql_num_rows($this->result);
	}
	
	public function num_fields() {
		return mssql_num_fields($this->result);
	}
	
	public function list_fields() {
		$field_names = array();
		while ($field = mssql_fetch_field($this->result))
		{
			$field_names[] = $field->name;
		}

		return $field_names;
	}
	
	public function field_data() {
		$retval = array();
		while ($field = mssql_fetch_field($this->result))
		{
			$F				= new stdClass();
			$F->name		= $field->name;
			$F->type		= $field->type;
			$F->default		= $field->def;
			$F->max_length	= $field->max_length;
			$F->primary_key = $field->primary_key;

			$retval[] = $F;
		}

		return $retval;
	}

	public function fetch_row() {
		return mssql_fetch_row($this->result);
	}

	public function fetch_assoc() {
		return mssql_fetch_assoc($this->result);
	}
	
	public function fetchall_assoc() {
		$retval = array();
		while ($row = $this->fetch_assoc()){
		$retval[] = $row;
		}
	return $retval;
	}
	
	public function fetch_all () {
		return mssql_fetch_array($this->result);
	}
	
	public function fetch_object()
	{
		return mssql_fetch_object($this->result);
	}
	
	public function free_result()
	{
		if (is_resource($this->result))
		{
			mssql_free_result($this->result);
			$this->result = FALSE;
		}
	}
}
?>