<?php
//echo __FILE__ . ':' . __LINE__ . "\n";
//if(!isset($_SESSION)) { session_start( session_id('vl42tudtr63t6vbgjkvng8sv') ); }
//if(!isset($_SESSION)) { session_start(); }
//echo __FILE__ . ':' . __LINE__ . "\n";
error_reporting(-1);
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', 'debug'); 

exec('cd /home/xpm/xpm-bal/');
exec('export PATH=$PATH:/home/xpm/xpm-bal/:./');

//echo __FILE__ . ':' . __LINE__ . "\n";
/* Connect to an ODBC database using driver invocation */
$dsn = 'mysql:dbname=c1xpm;host=127.0.0.1';
$user = 'c1xpm';
$password = 'SErnbxFBtHy9';

//echo __FILE__ . ":" . __LINE__ . "\n";

if (!isset($pdo))
{
	//echo 'creating pdo object' . "\n";
	try {
		$pdo = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

}

