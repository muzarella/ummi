
<?php 
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {
// admin case 
if (isset($_POST['submit_create_student'])) {
$surname = $_POST['last_name'] ;
$first_name = $_POST['first_name'];
$other_name = $_POST['other_name'] ;
$gender = $_POST['gender'] ;
$dob = $_POST['dob'] ;
$guardian_name = $_POST['guardian'] ;
$guardian_phone = $_POST['phone_number'] ;
$address = $_POST['address'] ;
$class_id = $_POST['class_id'] ;
$teacher_id = $_SESSION['id'] ;
$image = $_FILES['image_upload']['name'] ;

if ($surname ==""){
	echo "<script> alert('Please enter your surname '); </script>" ;
}elseif($first_name ==""){
 echo "<script> alert('Please enter your first name'); </script>" ;
}elseif ($class_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}elseif($teacher_id==""){
echo "<script> window.loction('../index.php'); </script>" ;
}elseif ($other_name == "") {
	echo "<script> alert('Please enter your other name '); </script>" ;
}elseif ($gender == "") {
	echo "<script> alert('Please enter your gender'); </script>" ;
}elseif ($dob == "") {
	echo "<script> alert('Please enter your date of birth '); </script>" ;
}elseif ($guardian_name == "") {
	echo "<script> alert('Please enter your Parent name '); </script>" ;
}elseif ($guardian_phone == "") {
	echo "<script> alert('Please enter your parent phone number '); </script>" ;
}elseif ($address == "") {
	echo "<script> alert('Please enter your parent address '); </script>" ;
}

/* 
code to upload an immage 
*/
function saveImage(){
$image = $_FILES['image_upload']['name'] ;
$target_dir = "../uploads/";
$target = $target_dir.basename($image);
// select file type 
$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
// VALID FILE EXXTENSION 
$extensions_arr = array("jpg","png","jpeg","gif");
// check extension 
if(in_array($imageFileType, $extensions_arr)){

$move = move_uploaded_file($_FILES['image_upload']['tmp_name'],$target);
if( $move){
$image_value = $target_dir.$image ;
}else {
echo " image cannot be moved to target directory " ;
}

}else {
echo " File extension no recognised please ensure your image is  a supported format  "; 
}

return $image_value ;
}
// end of the function
$image_object = saveImage();
 

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$obj->create_student( $surname,$first_name,$other_name,$gender,$dob,$guardian_name,$guardian_phone,$address,$class_id,$teacher_id,$image_object );

}



//  not admin case 
if (isset($_POST['submit_edit_student'])) {

if (isset($_GET['student_id'])) {
	if(!empty($_GET['student_id'])){
		$student_id = intval($_GET['student_id']) ;
	}else{
		header("location:manage_student.php") ;
	}
	
}

$surname = $_POST['last_name'] ;
$first_name = $_POST['first_name'];
$other_name = $_POST['other_name'] ;
$gender = $_POST['gender'] ;
$dob = $_POST['dob'] ;
$guardian_name = $_POST['guardian'] ;
$guardian_phone = $_POST['phone_number'] ;
$address = $_POST['address'] ;
$class_id = $_POST['class_id'] ;
$teacher_id = $_SESSION['id'] ;
$image = $_FILES['image_upload']['name'] ;

/*$surname,$first_name,$other_name,$gender,$dob,$guardian_name,$guardian_phone,$address,$class_id,$teacher_id*/
//echo "<script> alert(''); </script>"
if ($surname ==""){
	echo "<script> alert('Please enter your surname '); </script>" ;
}elseif($first_name ==""){
 echo "<script> alert('Please enter your first name'); </script>" ;
}elseif ($class_id == "") {
	echo "<script> alert('Please enter your class name '); </script>" ;
}elseif($teacher_id==""){
echo "<script> window.loction('../index.php'); </script>" ;
}elseif ($other_name == "") {
	echo "<script> alert('Please enter your other name '); </script>" ;
}elseif ($gender == "") {
	echo "<script> alert('Please enter your gender'); </script>" ;
}elseif ($dob == "") {
	echo "<script> alert('Please enter your date of birth '); </script>" ;
}elseif ($guardian_name == "") {
	echo "<script> alert('Please enter your Parent name '); </script>" ;
}elseif ($guardian_phone == "") {
	echo "<script> alert('Please enter your parent phone number '); </script>" ;
}elseif ($address == "") {
	echo "<script> alert('Please enter your parent address '); </script>" ;
}elseif ($image=="") {
	echo "<script> alert('Please select an image  '); </script>" ;
}

/* 
code to upload an immage 
*/
function saveImage(){
$image = $_FILES['image_upload']['name'] ;
$target_dir = "../uploads/";
$target = $target_dir.basename($image);
// select file type 
$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
// VALID FILE EXXTENSION 
$extensions_arr = array("jpg","png","jpeg","gif");
// check extension 
if(in_array($imageFileType, $extensions_arr)){

$move = move_uploaded_file($_FILES['image_upload']['tmp_name'],$target);
if( $move){
$image_value = $target_dir.$image ;
}else {
echo " image cannot be moved to target directory " ;
}

}else {
echo " File extension no recognised please ensure your image is  a supported format  "; 
}

return $image_value ;
}
// end of the function
$image_object = saveImage();
 

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$_SESSION['user'] = $_POST['username'] ;

$obj->edit_student( $surname,$first_name,$other_name,$gender,$dob,$guardian_name,$guardian_phone,$address,$class_id,$teacher_id,$image_object,$student_id );
}

if (isset($_GET['student_id'])){
	$student_id = intval($_GET['student_id']) ;

	include('../config/DbFunctions.php');
	$obj = new DbFunction(); 
	$obj->delete_student($student_id) ;
}

	 }
?>


