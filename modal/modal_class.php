
<?php 
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {

if (isset($_POST['submit_create_class'])) {
	
$class_name = $_POST['class_name'] ;
$class_code = $_POST['class_code'];
$assigned_teacher_id = $_POST['assigned_teacher'] ;

if ($class_name ==""){
	echo "<script> alert('Please enter a subject name '); </script>" ;
}elseif($class_code==""){
 echo "<script> alert('Please enter a subject code '); </script>" ;
}elseif ($assigned_teacher_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$query = $obj->show_teacher_Byid($assigned_teacher_id) ;
$result = $query->fetch(PDO::FETCH_OBJ) ;

$first_name = $result->first_name ;
$last_name =  $result->last_name ;
$teacher_name = $last_name." ". $first_name ;

$obj->create_class($class_name, $class_code, $assigned_teacher_id,$teacher_name ) ;

}


if(isset($_POST['submit_edit_class'])){
	if (isset( $_GET['classid'])) {
	$class_id = $_GET['classid'] ;
	}else{
		header("Location:manage_class.php");
	}

$class_name = $_POST['class_name'] ;
$class_code = $_POST['class_code'];
$assigned_teacher_id = $_POST['assigned_teacher'] ;

if ($class_name ==""){
	echo "<script> alert('Please enter a subject name '); </script>" ;
}elseif($class_code==""){
 echo "<script> alert('Please enter a subject code '); </script>" ;
}elseif ($assigned_teacher_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$query = $obj->show_teacher_Byid($assigned_teacher_id) ;
$result = $query->fetch(PDO::FETCH_OBJ) ;

$first_name = $result->first_name ;
$last_name =  $result->last_name ;
$teacher_name = $last_name." ". $first_name ;

$obj->edit_class($class_name, $class_code, $assigned_teacher_id,$teacher_name, $class_id ) ;



}
// end  of update class 

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








