<?php

abstract class Database {
	protected $registry;
	abstract protected function __construct($registry); 
	abstract public function connect($params); //Connect to the database engine
	abstract public function disconnect($link); //Disconnect from the database engine
	abstract public function database($params); //Connect to the database
	abstract public function exec($query, $params); //Execute a query
	abstract protected function __destruct(); //Close database connection on destruct
	
}

abstract class Result {
	public $result; //Query result
	public $link; //Database resource
	abstract public function __construct($link);
	abstract public function num_rows(); //Returns the number of the rows
	abstract public function num_fields(); //Returns the number of the fields
	abstract public function list_fields(); //Returns an array of field names
	abstract public function field_data(); //Returns a multi-array of field meta-data
	abstract public function fetch_row(); //Returns an array of the first row
	abstract public function fetch_assoc(); //Returns an associative array of the first row
	abstract public function fetchall_assoc(); //Returns an associative array of all data
	abstract public function fetch_all(); //Returns fetch array
	abstract public function fetch_object(); //Returns fetch object
	abstract public function free_result(); //Free the result
}

?>