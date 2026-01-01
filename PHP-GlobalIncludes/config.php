<?php
define('DB_HOST', '10.168.72.203');
define('DB_USER', 'sa');
define('DB_PASSWORD', 'frcadmin01');
define('DB_DATABASE', 'frccareers');

global $errflag, $errmsg_arr;

$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Connect to mysql server
$link = mssql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mssql_error());
}

//Select database
$db = mssql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}

?>