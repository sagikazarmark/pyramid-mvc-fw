<?php
require_once ('sys/database/database.php');
require_once ('sys/database/drivers/mysql.php');


$db = new mySQLDatabase($registry);

if ($db->config['link']) {
$result = $db->exec("SELECT * FROM menu WHERE ID = '09d8f41d784d3c29534da15542baf04c'");
print_r ($result->fetch_assoc());
}
?>