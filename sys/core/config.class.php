<?php

Class Config {

/*
 * @the registry
 * @access private
 */
private $registry;

/*
 * @Variables array
 * @access private
 */
private $vars = array();

/**
 *
 * @constructor
 *
 * @access public
 *
 * @return void
 *
 */
 
 
 
function __construct($registry) {
	$this->registry = $registry;

}



 /**
 *
 * @set undefined vars
 *
 * @param string $index
 *
 * @param mixed $value
 *
 * @return void
 *
 */
 public function __set($index, $value)
 {
        $this->vars[$index] = $value;
 }

 
  public function __get($index)
 {
	return $this->vars[$index];
 }

public function load_config ($config) {
	global $registry;
	if (empty($this->vars[$config])) {
		require __CONFIG_PATH . $config . '.config.php';
		return true;
	}
	
	return false;
}

}

?>
