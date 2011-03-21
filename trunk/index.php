<?php

/*** Error reporting on ***/
error_reporting(E_ALL);

/*** System and application folder ***/
$sys_folder = "sys";
$app_folder = "app";
$m_folder = "model";
$v_folder = "view";
$c_folder = "controller";

/*** Define the site, application, system, config, model, view, controller path ***/
$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', str_replace("\\", "/", $site_path) . '/');
define ('__APP_PATH', __SITE_PATH . $app_folder . '/');
define ('__SYS_PATH', __SITE_PATH . $sys_folder . '/');
define ('__CONFIG_PATH', __APP_PATH . 'config/');
define ('__M_PATH', __APP_PATH . $m_folder . '/');
define ('__V_PATH', __APP_PATH . $v_folder . '/');
define ('__C_PATH', __APP_PATH . $c_folder . '/');

/*** Check if the dir structure is correct ***/
if (!is_dir(__APP_PATH)) {
	throw new Exception("Application path does not exists.");
}

if (!is_dir(__SYS_PATH)) {
	throw new Exception("System path does not exists.");
}

if (!is_dir(__CONFIG_PATH)) {
	throw new Exception("Config path does not exists.");
}

if (!is_dir(__M_PATH)) {
	throw new Exception("Model path does not exists.");
}

if (!is_dir(__V_PATH)) {
	throw new Exception("View path does not exists.");
}

if (!is_dir(__C_PATH)) {
	throw new Exception("Controller path does not exists.");
}

/*** Include the bootstrap.php file ***/
require __SYS_PATH . 'bootstrap.php';
 

/*** set the controller path ***/
$registry->router->setPath (__C_PATH);

/*** Load configs ***/
$registry->config->load_config('database');

/*** Load the controller ***/
$registry->router->loader();


if ($registry->database->config['link']) {
$result = $registry->database->exec("SELECT * FROM menu WHERE ID = '26e89b9542f2166d9aede417298aef41'");
print_r ($result->fetch_assoc());
}

?>