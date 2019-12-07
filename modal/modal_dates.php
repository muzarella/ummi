<?php 
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {

if (isset($_POST['vacation_date'])) {
	
$vacation = $_POST['vacation'] ;

if ($vacation ==""){
	echo "<script> alert('Please enter vacation date '); </script>" ;
	echo "<script type='text/javascript'>document.location='../admin/date_details.php'</script>";
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

$obj->Update_vacation($vacation ) ;

}
// end of vacation 

if(isset($_POST['resumption_date'])){
	
$resumption = $_POST['resumption'] ;

if ($resumption ==""){
	echo "<script> alert('Please enter resumption date '); </script>" ;
	echo "<script type='text/javascript'>document.location='../admin/date_details.php'</script>";
}
include('../config/DbFunctions.php');
$obj = new DbFunction(); 
$obj->update_resumption($resumption ) ;

}
// end  of update resumption


if (isset($_GET['classid'])){
	$class_id = intval($_GET['classid']) ;

	include('../config/DbFunctions.php');
	$obj = new DbFunction(); 
	$obj->delete_class($class_id) ;
}else{
	echo "<script> alert('Data cannot be deleted') ; </script
	?> " ;
}
// end of delete class 


 }
?>








