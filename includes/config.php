<?php
ob_start();
//database credentials
// define('DBHOST','localhost:3311:3308');
// define('DBUSER','root');
// define('DBPASS','');
// define('DBNAME','gst_db');

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','bills');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//set timezone
date_default_timezone_set('Asia/Kolkata');


spl_autoload_register( function($class)
{ 
   $class = strtolower($class);

	//if call from within assets adjust the path
   $classpath = 'model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
	
	//if call from within admin adjust the path
   $classpath = '../model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
	
	//if call from within admin adjust the path
   $classpath = '../../model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
});

//load classes as needed

/*
function __autoload($class) {
   
   $class = strtolower($class);

	//if call from within assets adjust the path
   $classpath = 'model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
	
	//if call from within admin adjust the path
   $classpath = '../model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
	
	//if call from within admin adjust the path
   $classpath = '../../model/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
	 
}*/

$user = new user($db);
$tax = new tax($db); 
$category = new category($db);
$brand = new brand($db);
$item = new item($db);
$stock = new stock($db);
$client = new client($db);
$order = new order($db);
$comp = new company($db);
$supplier = new supplier($db);
$report = new report($db);
$password = new Password();
include('functions.php');
?>