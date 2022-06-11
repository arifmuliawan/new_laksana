<?php
session_start();
error_reporting(0);
$my_server	= "localhost";
$my_user 	= "root";
$my_password= "";
$my_db		= "laksana"; 	
$con 		= new mysqli($my_server,$my_user,$my_password,$my_db);
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
$base_url	= 'http://localhost/new_laksana/';
?>