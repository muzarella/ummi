<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {



if(isset($_POST['admin_submit_result'])) {

if (isset($_GET['student_id'])) {
	if(!empty($_GET['student_id'])){
		$student_id = intval($_GET['student_id']) ;
		if(! is_numeric($student_id)){

		echo htmlentities(" invalid student class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
if (isset($_GET['class_id'])) {
	if(!empty($_GET['class_id'])){
		$class_id = intval($_GET['class_id']) ;
		if(! is_numeric($class_id)){

		echo htmlentities(" invalid class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
$teacher_id = $_SESSION['id'] ;
$exam_mark = array();
$first_test = array();
$second_test = array();

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// $query =  $obj->show_subject_ByClassid($class_id) ;
// show_subject_Byclassid($class_id)
$subjectlist_id = $_POST['subjectlist_id']; 

$subj_id = array();
/*while($results  = $query->fetch(PDO::FETCH_OBJ) ){
	array_push($subj_id, $results->subjectlist_id );
}*/

foreach ($subjectlist_id as $subject) {
	array_push($subj_id, $subject );
}

$exam = $_POST['exam'] ;
$first= $_POST['first_test'];
$second= $_POST['second_test'] ;
$subject_id = count($subj_id);

$query_sess = $obj->get_current_session();
$result =$query_sess->fetch(PDO::FETCH_OBJ); 
$session = $result->session_id;

$query_term = $obj->get_current_term();
$result2 =$query_term->fetch(PDO::FETCH_OBJ); 
$term = $result2->term_id ;
/*for ($i = 0 ; $i<count($subj_id); $i++){
	echo "subj id = ".$subj_id[$i]."<br />" ;
}*/
/*echo "session id =".$session ;
echo "term =".$term ;*/
for($i= 0; $i<$subject_id; $i++ ){
	$exam_mark = $exam[$i];
	$first_test= $first[$i];
	$second_test= $second[$i];
	$subjects= $subj_id[$i];
/**	echo " subjecct_id =".$subjects." first_test =".$first_test." second test= ".$second_test." exam = ".$exam_mark."<br />" ; **/

$obj->admin_add_result($student_id, $class_id, $subjects, $session, $term, $first_test, $second_test, $exam_mark ) ;

}
// end of for loop


/*
foreach ($exam as $key => $value) {   
 $exam_marks = $value;                  
    foreach ($first as $key => $value) {
    	 $first_tests = $value;
		foreach($second as $key => $value){
	     	$second_tests = $value;
	     	
		}
       
    }       
    echo "result are first_test =".$first_tests." second test= ".$second_tests." exam = ".$exam_marks."<br />" ;
}
// end of foreach loop
*/
}
// end of add result




if(isset($_POST['submit_result'])) {

if (isset($_GET['student_id'])) {
	if(!empty($_GET['student_id'])){
		$student_id = intval($_GET['student_id']) ;
		if(! is_numeric($student_id)){

		echo htmlentities(" invalid student class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
if (isset($_GET['class_id'])) {
	if(!empty($_GET['class_id'])){
		$class_id = intval($_GET['class_id']) ;
		if(! is_numeric($class_id)){

		echo htmlentities(" invalid class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
$teacher_id = $_SESSION['id'] ;
$exam_mark = array();
$first_test = array();
$second_test = array();

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
$query =  $obj->show_subject_By_class_teacher($class_id ,$teacher_id) ;
$subj_id = array();
while($results  = $query->fetch(PDO::FETCH_OBJ) ){
	array_push($subj_id, $results->subject_id );
}

$exam = $_POST['exam'] ;
$first= $_POST['first_test'];
$second= $_POST['second_test'] ;
$subject_id = count($subj_id);

$query_sess = $obj->get_current_session();
$result =$query_sess->fetch(PDO::FETCH_OBJ); 
$session = $result->session_id;

$query_term = $obj->get_current_term();
$result2 =$query_term->fetch(PDO::FETCH_OBJ); 
$term = $result2->term_id ;
/*for ($i = 0 ; $i<count($subj_id); $i++){
	echo "subj id = ".$subj_id[$i]."<br />" ;
}*/
/*echo "session id =".$session ;
echo "term =".$term ;*/
for($i= 0; $i<$subject_id; $i++ ){
	$exam_mark = $exam[$i];
	$first_test= $first[$i];
	$second_test= $second[$i];
	$subjects= $subj_id[$i];
	/*echo " subjecct_id =".$subjects." first_test =".$first_test." second test= ".$second_test." exam = ".$exam_mark."<br />" ;*/

 $obj->add_result($student_id, $class_id, $subjects, $session, $term, $first_test, $second_test, $exam_mark ) ;

}
// end of for loop


/*
foreach ($exam as $key => $value) {   
 $exam_marks = $value;                  
    foreach ($first as $key => $value) {
    	 $first_tests = $value;
		foreach($second as $key => $value){
	     	$second_tests = $value;
	     	
		}
       
    }       
    echo "result are first_test =".$first_tests." second test= ".$second_tests." exam = ".$exam_marks."<br />" ;
}
// end of foreach loop
*/
}
// end of add result




// beggining of admin  update 
if(isset($_POST['admin_edit_result'])) {

if (isset($_GET['student_id'])) {
	if(!empty($_GET['student_id'])){
		$student_id = intval($_GET['student_id']) ;
		if(! is_numeric($student_id)){

		echo htmlentities(" invalid student class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
if (isset($_GET['class_id'])) {
	if(!empty($_GET['class_id'])){
		$class_id = intval($_GET['class_id']) ;
		if(! is_numeric($class_id)){

		echo htmlentities(" invalid class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
//$teacher_id = $_SESSION['id'] ;
$exam_mark = array();
$first_test = array();
$second_test = array();

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
//$query =  $obj->show_result_ByStudent_classid($class_id ,$student_id) ;
$subj_id = array();

/*while($results  = $query->fetch(PDO::FETCH_OBJ) ){
	array_push($subj_id, $results->subject_id );
}*/
$subject_id = $_POST['subject_id'] ;
foreach ($subject_id as $subject) {
	array_push($subj_id, $subject );
}


$exam = $_POST['exam'] ;
$first= $_POST['first_test'];
$second= $_POST['second_test'] ;
$subject_id = count($subj_id);

$query_sess = $obj->get_current_session();
$result =$query_sess->fetch(PDO::FETCH_OBJ); 
$session = $result->session_id;

$query_term = $obj->get_current_term();
$result2 =$query_term->fetch(PDO::FETCH_OBJ); 
$term = $result2->term_id ;

/*for ($i = 0 ; $i<count($subj_id); $i++){
	echo "subj id = ".$subj_id[$i]."<br />" ;
}*/

for($i= 0; $i<$subject_id; $i++ ){
	$exam_mark = $exam[$i];
	$first_test= $first[$i];
	$second_test= $second[$i];
	$subjects= $subj_id[$i];
/** echo "session=".$session."term=". $term." subject_id =".$subjects." first_test =".$first_test." second test= ".$second_test." exam = ".$exam_mark."<br />" ; **/
 $obj->admin_update_result($student_id, $class_id, $subjects, $first_test, $second_test, $exam_mark,$session,$term) ;
}
// end of for loop
//echo "<script type='text/javascript'>document.location='../views/manage_result.php'</script>";
}
// end of admin update result




// beggining of update 
if(isset($_POST['edit_result'])) {

if (isset($_GET['student_id'])) {
	if(!empty($_GET['student_id'])){
		$student_id = intval($_GET['student_id']) ;
		if(! is_numeric($student_id)){

		echo htmlentities(" invalid student class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
if (isset($_GET['class_id'])) {
	if(!empty($_GET['class_id'])){
		$class_id = intval($_GET['class_id']) ;
		if(! is_numeric($class_id)){

		echo htmlentities(" invalid class id ");
		exit();
	}
	}
}else{
	header("location:result.php");
	exit();
}
//$teacher_id = $_SESSION['id'] ;
$exam_mark = array();
$first_test = array();
$second_test = array();

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
$query =  $obj->show_result_ByStudent_classid($class_id ,$student_id) ;
$subj_id = array();
while($results  = $query->fetch(PDO::FETCH_OBJ) ){
	array_push($subj_id, $results->subject_id );
}
$exam = $_POST['exam'] ;
$first= $_POST['first_test'];
$second= $_POST['second_test'] ;
$subject_id = count($subj_id);

$query_sess = $obj->get_current_session();
$result =$query_sess->fetch(PDO::FETCH_OBJ); 
$session = $result->session_id;

$query_term = $obj->get_current_term();
$result2 =$query_term->fetch(PDO::FETCH_OBJ); 
$term = $result2->term_id ;

/*for ($i = 0 ; $i<count($subj_id); $i++){
	echo "subj id = ".$subj_id[$i]."<br />" ;
}*/

for($i= 0; $i<$subject_id; $i++ ){
	$exam_mark = $exam[$i];
	$first_test= $first[$i];
	$second_test= $second[$i];
	$subjects= $subj_id[$i];
echo "session=".$session."term=". $term." subjecct_id =".$subjects." first_test =".$first_test." second test= ".$second_test." exam = ".$exam_mark."<br />" ;
 $obj->update_result($student_id, $class_id, $subjects, $first_test, $second_test, $exam_mark,$session,$term) ;
}
// end of for loop
//echo "<script type='text/javascript'>document.location='../views/manage_result.php'</script>";
}
// end of update result




}

?>