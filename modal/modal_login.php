<?php 
session_start() ;
if ( $_SESSION['id'] !=''){
	 $_SESSION['id'] = '' ;
}

if (isset($_POST['submit'])) {
	
$username = $_POST['username'] ;
$password = $_POST['password'];

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$obj->login($username, $password) ;

}

?>