<?php

Class Registry {

/*
* @the vars array
* @access private
*/
private $vars = array();

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
public function __set($index, $value) {
	$this->vars[$index] = $value;
}

/**
*
* @get variables
*
* @param mixed $index
*
* @return mixed
*
*/
public function __get($index) {
	return $this->vars[$index];
}

public function load_class ($class, $load = true, $directory = 'core', $path = __SYS_PATH) {
	if (empty($this->vars[$class]) or !class_exists($this->vars[$class])) {
		require $path . $directory . '/' . $class . '.class.php';
		if ($load) { $this->vars[$class] = new $class ($this); }
		return true;
	}
	
	return false;
}


}
?>
