<?php
$registry->config->database = array (
	'default' => array (
		'driver' =>	'mysql',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'dbname' => 'maindev',
		'persistent' => true,
		'tableprefix' => '',
		'log' => false,
		'autoinit' => true
	),
	'default_connection' => 'default'
);

require __SYS_PATH . 'database/drivers/'.$registry->config->database[$registry->config->database['default_connection']]['driver'].'.driver.php';
$class = $registry->config->database[$registry->config->database['default_connection']]['driver'].'Database';
$registry->database = new $class($registry);

?>