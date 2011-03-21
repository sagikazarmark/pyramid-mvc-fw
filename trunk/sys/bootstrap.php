<?php

/*** Include most common functions (handlers, etc.)  ***/
include 'common.php';


/*** Include the controller class ***/
include __SYS_PATH . 'core/controller_base.class.php';

/*** Include the registry class ***/
require __SYS_PATH . 'core/registry.class.php';

/*** A new registry object ***/
$registry = new registry;

/*** Load classes ***/
$registry->load_class('router');
$registry->load_class('template');
$registry->load_class('config');
$registry->load_class('database', false, 'database', __SYS_PATH);

/*** Include the exception class ***/
// include __SYS_PATH . 'core/exception.class.php';

// set_error_handler('_exception_handler');


 /*** auto load model classes ***/
    function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __M_PATH . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}
?>
