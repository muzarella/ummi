
<?php 
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {
//  admin case 

if (isset($_POST['create_subject_List'])){
$subject_name = $_POST['subject_name'] ;
$subject_code = $_POST['subject_code'] ;

if ($subject_name ==  ""){
echo "<script> alert('Please enter a subject name '); </script>" ;
exit();
}
if($subject_code == "" ){
 echo "<script> alert('Please enter a subject code '); </script>" ;
 exit();
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$obj->create_subject_list($subject_name, $subject_code) ;


}
// end of creating a subject list 

if (isset($_POST['edit_subject_List'])){

if (isset($_GET['subject_id'])) {
	if(!empty($_GET['subject_id'])){
		$subject_id = intval($_GET['subject_id']) ;
	}
	
}else{
	header("location:manage_subject_comb.php");
}

$subject_name = $_POST['subject_name'] ;
$subject_code = $_POST['subject_code'] ;

if ($subject_name ==  ""){
echo "<script> alert('Please enter a subject name '); </script>" ;
exit();
}
if($subject_code == "" ){
 echo "<script> alert('Please enter a subject code '); </script>" ;
 exit();
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
$obj->edit_subject_list($subject_id,$subject_name, $subject_code) ;

}
// end of editing  a subject list

if (isset($_POST['submit_create_subject_comb'])) {
	
$subject_id = $_POST['subject_id'] ;
$class_id = $_POST['class_id'] ;
$teacher_id = $_POST['teacher_id'] ;

//echo "<script> alert(''); </script>"
if ($subject_id ==""){
	echo "<script> alert('Please enter a subject name '); </script>" ;
}elseif ($class_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}elseif($teacher_id==""){
echo "<script> window.loction('../index.php'); </script>" ;
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;
$obj->create_subject($subject_id, $class_id,$teacher_id ) ;

}


if (isset($_POST['submit_edit_subject'])) {
	
if (isset($_GET['subject_id'])) {
	if(!empty($_GET['subject_id'])){
		$subject_id = intval($_GET['subject_id']) ;
	}
	
}else{
	header("location:manage_subject_comb.php");
}

$subject_name = $_POST['subjectlist_id'] ;
$class_id = $_POST['class_id'] ;
$teacher_id = $_SESSION['id'] ;

//echo "<script> alert(''); </script>"
if ($subject_name ==""){
	echo "<script> alert('Please enter a subject name '); </script>" ;
}elseif ($class_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}elseif($teacher_id==""){
	echo "<script> alert('Please enter your teacher name '); </script>" ;

}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
echo "subject  name = ". $subject_name;
echo "class  name = ". $class_id;
echo "teacher  name = ". $teacher_id;

$obj->edit_subject($subject_id, $subject_name, $class_id,$teacher_id ) ;


}

if (isset($_GET['classid'])){
	$class_id = intval($_GET['classid']) ;

	include('../config/DbFunctions.php');
	$obj = new DbFunction(); 
	$obj->delete_subject($class_id) ;
}

 }
?>








