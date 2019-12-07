<?php 

require('database.php') ;

// $db = database::getInstance ();
// $mysql = $db->getConnection();

class DbFunction {

function login($username, $password){

	if (!ctype_alpha($username) || !ctype_alpha($password)){
		echo "<script> alert('Either the login or password is missing ');  </script>";

	}else {

$db = Database::getInstance();
$conn = $db->getConnection();
$query = "SELECT  teacher_id, username , password,status FROM tbl_teachers WHERE username = :username AND password = :password " ;
$stmt = $conn->prepare($query); 
if(false===$stmt){
		
		trigger_error("Error in query: " . mysqli_connect_error(),E_USER_ERROR);
	}else{

$stmt->bindParam(':username',$username,PDO::PARAM_STR) ;
$stmt->bindParam('password', $password,PDO::PARAM_STR) ; 
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount()>0 ) {

 foreach ($results as $result) {
 	# code...
 	$id =$result['teacher_id']  ;
 $check_status = $result['status']  ;
 $_SESSION['id'] = $id ;

/*redirection still needing changes 
admin to admin index page 
and teacher to view index page  

*/
if ( $check_status ==='admin'){
echo "<script type='text/javascript'>document.location='../admin/index.php'</script>";

}elseif($check_status ==='teacher') {

echo "<script type='text/javascript'>document.location='../views/index.php'</script>";

	}else{
		echo "<script>alert('Invalid Status.. please kindly confirm your activities with your school'); 
</script>";
	}

 }
// end of foreaachh 
}else {
 
echo "<script>alert('Invalid Details'); 
</script>";
//document.location = '../index.php'
	//header('location:login.php');
}
	}
	}
}

/* end of login function */

/*beggining of function to create subject */
function create_subject($subject_id,$class_id,$teacher_id ) {
// not for admin
	$db = Database::getInstance();
$conn = $db->getConnection();

$sql = "SELECT class FROM tbl_class WHERE class_id =:class_id ";
$query = $conn->prepare($sql);
$query->bindParam(':class_id',$class_id,PDO::PARAM_STR) ;
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$class_name = $result->class ;

$sql = " INSERT INTO tbl_subject(subjectlist_id,class_id, teacher_id) VALUES (:subjectlist_id,:class_id,:teacher_id) ";

$query =$conn->prepare($sql);
$query->bindParam(':subjectlist_id' ,$subject_id,PDO::PARAM_STR ) ;
$query->bindParam(':class_id', $class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':teacher_id', $teacher_id,PDO::PARAM_STR ) ;
$query->execute();
$lastInsertId= $conn->lastInsertId();

if($lastInsertId){
	$_SESSION['msg'] = "Subject created successfully ";
	header('location:../admin/create_subject_comb.php');
}else{
	$_SESSION['error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/create_subject.php'</script>";
}

}
/* end of function to  create subject  */

/*beggining of function to create subject list */
function create_subject_list($subject_name, $subject_code) {
// not for admin
$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " INSERT INTO tbl_subject_list (subject_name, subject_code) VALUES (:subject_name, :subject_code ) " ;

$query =$conn->prepare($sql);
$query->bindParam(':subject_name' ,$subject_name,PDO::PARAM_STR ) ;
$query->bindParam( ':subject_code' ,$subject_code,PDO::PARAM_STR) ;
$query->execute();
$lastInsertId= $conn->lastInsertId();

if($lastInsertId){
	$_SESSION['msg'] = " Subject created successfully ";
	header('location:../admin/create_subject.php');
}else{
	$_SESSION['error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/create_subject.php'</script>";
}

}
/* end of function to  create subject  list */

/*beggining of function to create class */
function create_class($class_name, $class_code, $teacher_id, $teacher_name ) {

$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " INSERT INTO tbl_class(teacher_id,class, class_code,teacher_assigned ) VALUES (:teacher_id,:class, :class_code,:teacher_name) ";

$query =$conn->prepare($sql);
$query->bindParam(':teacher_id', $teacher_id,PDO::PARAM_STR) ;
$query->bindParam(':class' ,$class_name,PDO::PARAM_STR ) ;
$query->bindParam( ':class_code' ,$class_code,PDO::PARAM_STR) ;
$query->bindParam(':teacher_name', $teacher_name ,PDO::PARAM_STR) ;
$query->execute();
$lastInsertId= $conn->lastInsertId();

if($lastInsertId){
	$_SESSION['class_msg'] = " Class created successfully ";
	header('location:../admin/create_class.php');
}else{
	$_SESSION['class_error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/create_class.php'</script>";
}

}
/* end of function to  create class */

/*beggining of function to create student */
function  create_student( $surname,$first_name,$other_name,$gender,$dob,$guardian_name,$guardian_phone,$address,$class_id,$teacher_id,$image ){
$db = Database::getInstance();
$conn = $db->getConnection();
$sql = "INSERT INTO tbl_student(teacher_id, class_id,surname,first_name,other_name,gender,dob,guardian_name,guardian_phone,address,image) VALUES (:teacher_id,:class_id,:surname,:first_name,:other_name,:gender,:dob,:guardian_name,:guardian_phone,:address,:image) ";

$query =$conn->prepare($sql);
$query->bindParam(':teacher_id', $teacher_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':surname' ,$surname,PDO::PARAM_STR) ;
$query->bindParam(':first_name', $first_name,PDO::PARAM_STR ) ;
$query->bindParam(':other_name', $other_name,PDO::PARAM_STR ) ;
$query->bindParam(':gender', $gender,PDO::PARAM_STR ) ;
$query->bindParam(':dob', $dob,PDO::PARAM_STR ) ;
$query->bindParam(':guardian_name', $guardian_name,PDO::PARAM_STR ) ;
$query->bindParam(':guardian_phone', $guardian_phone,PDO::PARAM_STR ) ;
$query->bindParam(':address', $address,PDO::PARAM_STR ) ;
$query->bindParam(':image', $image,PDO::PARAM_STR ) ;
$query->execute();
$lastInsertId= $conn->lastInsertId();

if($lastInsertId){
	$_SESSION['msg'] = "Student data created successfully ";
	header('location:../admin/create_student.php');
}else{
	$_SESSION['error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../views/create_student.php'</script>";
}

}
/* end of function to  create student */

/* beggining o creating seession for the school year */

function  create_session($session){

$db = Database::getInstance();
$conn =$db->getConnection();

$sql = " INSERT INTO tbl_session (session) VALUES(:session)  " ;
$query = $conn->prepare($sql);
$query->bindValue(':session', $session ) ;
$query->execute();

$lastInsertId = $conn->lastInsertId();
if ($lastInsertId){
$_SESSION['msg'] = "Another Year  of school session successfully Added " ;
echo "<script type='text/javascript'>document.location='../admin/create_session.php'</script>";

}else{
$_SESSION['error'] = "something went wrong! Please try again later" ;
echo "<script> alert('something went wrong! Please try again later')    </script>" ;
echo "<script type='text/javascript'>document.location='../admin/create_session.php'</script>";

}


}

/*ending of creating school year for the student */


/*beggining of function to insert result */
function admin_add_result ($student_id, $class_id, $subject_id, $session, $term, $first_test, $second_test, $exam_score ) {

$db = Database::getInstance();
$conn = $db->getConnection();
//student id , class id , subject id, session , term, first test, second test, exam score
$sql = " INSERT INTO tbl_result(student_id,class_id, subject_id,session_id,term_id,first_test,second_test,exam_score ) VALUES (:student_id,:class_id,:subject_id,:session,:term,:first_test,:second_test,:exam_score) ";

$query =$conn->prepare($sql);
$query->bindParam(':student_id', $student_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':subject_id' ,$subject_id,PDO::PARAM_STR) ;
$query->bindParam(':session', $session,PDO::PARAM_STR);
$query->bindParam(':term', $term,PDO::PARAM_STR);
$query->bindParam(':first_test',$first_test,PDO::PARAM_STR);
$query->bindParam(':second_test', $second_test,PDO::PARAM_STR);
$query->bindParam(':exam_score', $exam_score,PDO::PARAM_STR);
$query->execute();
$lastInsertId= $conn->lastInsertId();
if($lastInsertId){
	$_SESSION['msg'] = " result added successfully ";
//	echo "<script> alert('result added successfully'); </script>";
	// echo "<script type='text/javascript'>document.location='../admin/result.php'</script>";
}else{
	$_SESSION['error'] = " Something went wrong while adding result. Please try again" ;
//	echo "<script> alert(' Something went wrong. Please try again'); </script>";
	echo "<script type='text/javascript'>document.location='../admin/result.php'</script>";
	
}

}
/* end of function to  insert result */

/*beggining of function to insert result */
function add_result ($student_id, $class_id, $subject_id, $session, $term, $first_test, $second_test, $exam_score ) {

$db = Database::getInstance();
$conn = $db->getConnection();
//student id , class id , subject id, session , term, first test, second test, exam score
$sql = " INSERT INTO tbl_result(student_id,class_id, subject_id,session_id,term_id,first_test,second_test,exam_score ) VALUES (:student_id,:class_id,:subject_id,:session,:term,:first_test,:second_test,:exam_score) ";

$query =$conn->prepare($sql);
$query->bindParam(':student_id', $student_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':subject_id' ,$subject_id,PDO::PARAM_STR) ;
$query->bindParam(':session', $session,PDO::PARAM_STR);
$query->bindParam(':term', $term,PDO::PARAM_STR);
$query->bindParam(':first_test',$first_test,PDO::PARAM_STR);
$query->bindParam(':second_test', $second_test,PDO::PARAM_STR);
$query->bindParam(':exam_score', $exam_score,PDO::PARAM_STR);
$query->execute();
$lastInsertId= $conn->lastInsertId();
if($lastInsertId){
	$_SESSION['msg'] = " result added successfully ";
//	echo "<script> alert('result added successfully'); </script>";
	echo "<script type='text/javascript'>document.location='../views/result.php'</script>";
}else{
	$_SESSION['error'] = " Something went wrong while adding result. Please try again" ;
//	echo "<script> alert(' Something went wrong. Please try again'); </script>";
	echo "<script type='text/javascript'>document.location='../views/result.php'</script>";
	
}

}
/* end of function to  insert result */


/*beggining of function to update admin  result */
function admin_update_result ($student_id, $class_id, $subject_id, $first_test, $second_test, $exam_score,$session,$term ) {
$db = Database::getInstance();
$conn = $db->getConnection();
$sql = " UPDATE tbl_result SET first_test=:first_test, second_test=:second_test, exam_score=:exam_score where student_id=:student_id && session_id=:session && term_id=:term && class_id =:class_id && subject_id=:subject_id  ";

$query =$conn->prepare($sql);
$query->bindParam(':student_id', $student_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':subject_id' ,$subject_id,PDO::PARAM_STR) ;
$query->bindParam(':session', $session,PDO::PARAM_STR);
$query->bindParam(':term', $term,PDO::PARAM_STR);
$query->bindParam(':first_test',$first_test,PDO::PARAM_STR);
$query->bindParam(':second_test', $second_test,PDO::PARAM_STR);
$query->bindParam(':exam_score', $exam_score,PDO::PARAM_STR);
$stmt = $query->execute();
if($stmt){
 $_SESSION['msg'] = " result updated successfully ";
//header('location:../views/manage_result.php');
	echo "<script> alert('result edit uploaded successfully'); </script>";
 //echo "<script type='text/javascript'>document.location='../views/manage_result.php'</script>";
}else{
	$_SESSION['error'] = " Something went wrong during upload. Please try again" ;
	echo "<script> alert(' Something went wrong. Please try again'); </script>";
	echo "<script type='text/javascript'>document.location='../admin/manage_result.php'</script>";

}

}
/* end of function to update result */


/*beggining of function to update result */
function update_result ($student_id, $class_id, $subject_id, $first_test, $second_test, $exam_score,$session,$term ) {
$db = Database::getInstance();
$conn = $db->getConnection();
$sql = " UPDATE tbl_result SET first_test=:first_test, second_test=:second_test, exam_score=:exam_score where student_id=:student_id && session_id=:session && term_id=:term && class_id =:class_id && subject_id=:subject_id  ";

$query =$conn->prepare($sql);
$query->bindParam(':student_id', $student_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':subject_id' ,$subject_id,PDO::PARAM_STR) ;
$query->bindParam(':session', $session,PDO::PARAM_STR);
$query->bindParam(':term', $term,PDO::PARAM_STR);
$query->bindParam(':first_test',$first_test,PDO::PARAM_STR);
$query->bindParam(':second_test', $second_test,PDO::PARAM_STR);
$query->bindParam(':exam_score', $exam_score,PDO::PARAM_STR);
$stmt = $query->execute();
if($stmt){
 $_SESSION['msg'] = " result updated successfully ";
//header('location:../views/manage_result.php');
	echo "<script> alert('result added successfully'); </script>";
 echo "<script type='text/javascript'>document.location='../views/manage_result.php'</script>";
}else{
	$_SESSION['error'] = " Something went wrong during upload. Please try again" ;
	echo "<script> alert(' Something went wrong. Please try again'); </script>";
	echo "<script type='text/javascript'>document.location='../views/manage_result.php'</script>";

}

}
/* end of function to update result */

/* beggining of funcction show teacher*/
function show_teacher(){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_teachers";
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show teacher*/

/* beggining of funcction show teacher by id */
function show_teacher_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_teachers WHERE teacher_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show teacher by id*/


/* beggining of function show class*/
function show_class(){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_class";
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class*/

/* beggining of function show class by id */
function show_class_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_class WHERE class_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by id*/


/* beggining of function show class by teacherid */
function show_class_teacherid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_class WHERE teacher_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by id*/

/* beggining of the show subject function */
function show_subject(){
	try {
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_subject " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
	} catch (PDOException $e) {
		$error = "Error fetching student data  ";
		//echo $error.getMessage->$e ;
		exit();
	}
} 

/* endding of the  show subject funcion */


/* beggining of the show subject function */
function show_subject_list(){
	try {
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_subject_list " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
	} catch (PDOException $e) {
		$error = "Error fetching student data  ";
		//echo $error.getMessage->$e ;
		exit();
	}
} 

/* endding of the  show subject funcion */

/* beggining of function show subject by id */
function show_subject_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	//$sql = "SELECT * FROM tbl_subject WHERE subject_id=:id";
	$sql = "SELECT tbl_subject.subject_id AS subject_id,tbl_subject.teacher_id AS teacher_id,tbl_subject.class_id AS class_id,tbl_subject_list.subject_name AS subject_name, tbl_subject_list.subject_code AS subject_code, tbl_class.class AS class_name FROM tbl_subject JOIN tbl_subject_list ON  tbl_subject.subjectlist_id = tbl_subject_list.subjectlist_id JOIN tbl_class ON tbl_subject.class_id = tbl_class.class_id  WHERE tbl_subject.subject_id = :id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':id',$id) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by id*/

/* beggining of function show subject list by id */
function show_subjectlist_Byid( $id ) {
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_subject_list WHERE subjectlist_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':id',$id) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show subject list by id*/

/* beggining of function show subject by classid */
function show_subject_ByClassid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT tbl_subject.subject_id AS subject_id,tbl_subject.teacher_id AS teacher_id,tbl_subject_list.subject_name AS subject_name, tbl_subject_list.subject_code AS subject_code,tbl_subject_list.subjectlist_id AS subjectlist_id,tbl_class.class AS class_name FROM tbl_subject JOIN tbl_subject_list ON  tbl_subject.subjectlist_id = tbl_subject_list.subjectlist_id JOIN tbl_class ON tbl_subject.class_id = tbl_class.class_id  WHERE tbl_subject.class_id = :id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':id',$id) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by id*/

/* beggining of function show subject by teacherid */
function show_subject_ByteacherId( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql ="SELECT class_id, class_name  FROM tbl_subject WHERE teacher_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by teacherid*/

/* beggining of function show subject by classid aand teacher id */
function show_subject_By_class_teacher($class_id,$teacher_id){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT tbl_subject.subject_id, tbl_subject_list.subject_name AS subject_names FROM tbl_subject JOIN tbl_subject_list on tbl_subject_list.subjectlist_id = tbl_subject.subjectlist_id WHERE class_id=:id && teacher_id=:teacher_id ";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':id',$class_id) ;
	$stmt->bindValue(':teacher_id',$teacher_id) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show class by id*/


/* beggining of the show student function */
function show_student(){
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_student " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
} 

/* endding of the  show student funcion */

/* beggining of function show sstudent by id */
function show_student_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_student WHERE student_id=:id LIMIT 1";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show student by id*/


/* beggining of function show sstudent by id */
function show_student_Byclassid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_student WHERE class_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show student by id*/

/* beggining of the show session function */
function show_session(){
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_session " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
} 

/* endding of the  show session funcion */


/* beggining of function show session by id */
function show_session_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_session WHERE session_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show session by id*/



/* beggining of the show term function */
function show_term(){
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_term " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
} 

/* endding of the  show term funcion */


/* beggining of the show date information function */
function show_date_details(){
	$db = Database::getInstance();
	$conn  = $db->getConnection();
	$sql  = " SELECT * FROM tbl_details" ;
	$stmt = $conn->prepare($sql) ;
	$stmt->execute();
	return $stmt ;
} 

/* endding of the  show date info  funcion */




/* beggining of function show result by classid aand student id */
function show_result_ByStudent_classid($class_id,$student_id,$session_id, $term_id){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT tbl_class.class as class,tbl_result.subject_id AS subject_id, tbl_subject_list.subject_name AS subject_names,tbl_student.surname ,tbl_student.first_name,tbl_result.result_id,tbl_result.first_test AS first_test,tbl_result.second_test as second_test,tbl_result.exam_score as exam_score FROM tbl_result  JOIN tbl_class on tbl_class.class_id = tbl_result.class_id JOIN tbl_subject_list on tbl_subject_list.subjectlist_id = tbl_result.subject_id  join tbl_student on tbl_student.student_id = tbl_result.student_id WHERE tbl_result.class_id=:id AND tbl_result.student_id=:student_id AND session_id = :session_id AND term_id = :term_id ";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':id',$class_id) ;
	$stmt->bindValue(':student_id',$student_id) ;
	$stmt->bindValue(':session_id', $session_id) ;
	$stmt->bindValue(':term_id', $term_id ) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show result by id*//* beggining of function show result by classid aand student id */

function check_result_if_AlreadyExisting($class_id,$student_id,$session_id, $term_id){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	/*$sql = "SELECT tbl_class.class as class,tbl_result.subject_id, tbl_subject_list.subject_name AS subject_names,tbl_student.surname ,tbl_student.first_name,tbl_result.result_id,tbl_result.first_test AS first_test,tbl_result.second_test as second_test,tbl_result.exam_score as exam_score FROM tbl_result  JOIN tbl_class on tbl_class.class_id = tbl_result.class_id JOIN tbl_subject_list on tbl_subject_list.subjectlist_id = tbl_result.subject_id  join tbl_student on tbl_student.student_id = tbl_result.student_id WHERE tbl_result.class_id=:id && tbl_result.student_id=:student_id ";*/
	$sql = " SELECT student_id, class_id, session_id, term_id  FROM tbl_result WHERE student_id = :student_id AND class_id =:class_id AND session_id = :session_id AND term_id = :term_id " ;
	$stmt = $conn->prepare($sql) ;
	$stmt->bindValue(':class_id',$class_id) ;
	$stmt->bindValue(':student_id',$student_id) ;
	$stmt->bindValue(':session_id', $session_id) ;
	$stmt->bindValue(':term_id', $term_id ) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show result by id*/

/* beggining of function get sesssion by id */
function get_session_Byid($session_id) {
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT session FROM tbl_session WHERE session_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$session_id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function get session  by id */


/* beggining of function get term by id */
function get_term_Byid($term_id) {
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT term FROM tbl_term WHERE term_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$term_id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function get term  by id */


/* beggining of function show school fees of class by id */
function show_fees_Byid( $id ){
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$sql = "SELECT * FROM tbl_school_fees WHERE class_id=:id";
	$stmt = $conn->prepare($sql) ;
	$stmt->bindParam(':id',$id,PDO::PARAM_STR) ;
	$stmt->execute();
	return $stmt ;
}
/* end of function show school fees of class by id */

/*get the current session id */
function get_current_session(){
	$db = Database::getInstance();
$conn = $db->getConnection();

$sql="SELECT * FROM current_session LIMIT 1" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt;
}
/* end of getting current session id */


/*get the current term id */
function get_current_term(){
	$db = Database::getInstance();
$conn = $db->getConnection();

$sql="SELECT * FROM current_term LIMIT 1" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt;
}
/* end of getting current term id */


/*get the current school details */
function get_current_SchoolDetails(){
	$db = Database::getInstance();
$conn = $db->getConnection();

$sql="SELECT * FROM tbl_details LIMIT 1" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt;
}
/* end of getting current school details */

/*beggining of function to update session table */
function update_session($session_id, $session ){
$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " UPDATE tbl_session SET session =:session WHERE session_id = :session_id " ;
$query = $conn->prepare($sql) ;
$query->bindParam(':session_id', $session_id ) ;
$query->bindParam(':session', $session,PDO::PARAM_STR ) ;
$exe = $query->execute();
if($exe){
	$_SESSION['msg'] = " Session updated successfully ";
	header('location:../admin/manage_session.php');
}else{
	$_SESSION['error'] = " Something went wrong!. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/manage_session.php'</script>";
}
}
/* ending of funnction to update session table*/

/*beggining of function to update session table */
function update_current_session($session_id, $session_date ){
$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " UPDATE current_session SET session_id =:session_id, session = :session_date " ;
$query = $conn->prepare($sql) ;
$query->bindParam(':session_id', $session_id ) ;
$query->bindParam(':session_date', $session_date,PDO::PARAM_STR ) ;
$exe = $query->execute();
if($exe){
	$_SESSION['msg'] = " Session updated successfully ";
	header('location:../admin/update_session.php');
}else{
	$_SESSION['error'] = " Something went wrong!. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/update_session.php'</script>";
}
}
/* ending of funnction to update session table*/


/*beggining of function to update term table */
function update_current_term($term_id, $term ){
$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " UPDATE current_term SET term_id =:term_id, term = :term " ;
$query = $conn->prepare($sql) ;
$query->bindParam(':term_id', $term_id ) ;
$query->bindParam(':term', $term ,PDO::PARAM_STR ) ;
$exe = $query->execute();
if($exe){
	$_SESSION['msg'] = " Session updated successfully ";
	header('location:../admin/update_term.php');
}else{
	$_SESSION['error'] = " Something went wrong!. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/update_term.php'</script>";
}
}
/* ending of funnction to update term table*/

/* beggining of function to update date inforation */
function Update_vacation($vacation ){
$db= Database::getInstance() ;
$conn = $db->getConnection();

$sql = "UPDATE tbl_details SET vacation_date = :vacation " ;
$query = $conn->prepare($sql) ;
$query->bindValue(":vacation", $vacation) ;
$exe = $query->execute() ;
if($exe){
		$_SESSION['msg'] = " Vacation updated successfully ";
	header('location:../admin/date_details.php');
}else {
	$_SESSION['error'] = " Something went wrong!. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/date_details.php'</script>";
}

}
/* endinng of function to update date info  */


/* beggining of function to update date inforation */
function Update_resumption($resumption ){
$db= Database::getInstance() ;
$conn = $db->getConnection();

$sql = "UPDATE tbl_details SET resumption_date = :resumption " ;
$query = $conn->prepare($sql) ;
$query->bindValue(":resumption", $resumption) ;
$exe = $query->execute() ;
if($exe){
		$_SESSION['msg'] = " Resumption date updated successfully ";
	header('location:../admin/date_details.php');
}else {
	$_SESSION['error'] = " Something went wrong!. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/date_details.php'</script>";
}

}
/* endinng of function to update date info  */

/*beggining of function to edit subject */
function edit_subject($subject_id, $subjectlist_id,$class_id,$teacher_id ) {
// not for admin
	$db = Database::getInstance();
$conn = $db->getConnection();
$sql = "UPDATE  tbl_subject SET subjectlist_id =:subjectlist_id, class_id=:class_id, teacher_id=:teacher_id  WHERE subject_id=:subject_id" ;

$query =$conn->prepare($sql);
$query->bindParam(':subject_id' ,$subject_id,PDO::PARAM_STR ) ;
$query->bindParam(':subjectlist_id' ,$subjectlist_id,PDO::PARAM_STR ) ;
$query->bindParam(':class_id', $class_id ,PDO::PARAM_STR) ;
$query->bindParam( ':teacher_id', $teacher_id,PDO::PARAM_STR ) ;
$exe = $query->execute();
if($exe){
	$_SESSION['update_msg'] = " Subject updated successfully ";
	header('location:../admin/manage_subject_comb.php');
}else{
	$_SESSION['update_error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/manage_subject_comb.php'</script>";
}

}
/* end of function to  edit subject  */

/* begginging of function to edit student list */
function edit_subject_list($subject_id,$subject_name, $subject_code){
$db = Database::getInstance();
$conn = $db->getConnection();
$sql = " UPDATE tbl_subject_list SET subject_name =:subject_name, subject_code = :subject_code WHERE subjectlist_id =:subject_id " ;
$query=  $conn->prepare($sql);
$query->bindParam(':subject_name',$subject_name,PDO::PARAM_STR ) ;
$query->bindParam(':subject_code', $subject_code,PDO::PARAM_STR) ;
$query->bindParam(':subject_id',$subject_id,PDO::PARAM_STR);
$exe = $query->execute();

if($exe){
$_SESSION['msg'] = " Subject updated successfully ";
	header('location:../admin/manage_subject.php');

}else{
$_SESSION['error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../admin/manage_subject.php'</script>";

}

}
/* ending of edditin subject list */

/* beggining of function update class by id */

function edit_class($class_name, $class_code, $assigned_teacher_id,$teacher_name, $class_id ){


$db = Database::getInstance();
$conn = $db->getConnection();

$sql = " UPDATE  tbl_class SET teacher_id=:teacher_id,class=:class, class_code= :class_code,teacher_assigned = :teacher_name Where class_id = :classid ";

$query =$conn->prepare($sql);
$query->bindParam(':teacher_id', $assigned_teacher_id, PDO::PARAM_STR) ;
$query->bindParam(':class' ,$class_name,PDO::PARAM_STR ) ;
$query->bindParam( ':class_code' ,$class_code,PDO::PARAM_STR) ;
$query->bindParam(':teacher_name', $teacher_name,PDO::PARAM_STR ) ;
$query->bindParam(':classid', $class_id ,PDO::PARAM_STR) ;
$stmt = $query->execute();
if ($stmt){
	$_SESSION['update_msg'] = "class Data Updated successfully" ;
	echo "<script type='text/javascript'>document.location='../admin/manage_class.php'</script>";
}else{
	$_SESSION['update_error'] = " Error updating class data: something went wrong- please try again " ;
	echo "<script type='text/javascript'>document.location='../views/manage_class.php'</script>";
}

}
/* end of function edit class by id*/


/*beggining of function to create student */
function  edit_student( $surname,$first_name,$other_name,$gender,$dob,$guardian_name,$guardian_phone,$address,$class_id,$teacher_id,$image,$student_id ){
$db = Database::getInstance();
$conn = $db->getConnection();
$sql = "UPDATE tbl_student SET teacher_id=:teacher_id, class_id=:class_id,surname=:surname,first_name=:first_name,other_name=:other_name,gender=:gender,dob=:dob,guardian_name=:guardian_name,guardian_phone=:guardian_phone,address=:address,image=:image WHERE student_id=:student_id ";

$query =$conn->prepare($sql);
$query->bindParam(':teacher_id', $teacher_id,PDO::PARAM_STR) ;
$query->bindParam(':class_id' ,$class_id,PDO::PARAM_STR ) ;
$query->bindParam( ':surname' ,$surname,PDO::PARAM_STR) ;
$query->bindParam(':first_name', $first_name,PDO::PARAM_STR ) ;
$query->bindParam(':other_name', $other_name,PDO::PARAM_STR ) ;
$query->bindParam(':gender', $gender,PDO::PARAM_STR ) ;
$query->bindParam(':dob', $dob,PDO::PARAM_STR ) ;
$query->bindParam(':guardian_name', $guardian_name,PDO::PARAM_STR ) ;
$query->bindParam(':guardian_phone', $guardian_phone,PDO::PARAM_STR ) ;
$query->bindParam(':address', $address,PDO::PARAM_STR ) ;
$query->bindParam(':image', $image,PDO::PARAM_STR ) ;
$query->bindParam(':student_id', $student_id,PDO::PARAM_STR ) ;
$exe = $query->execute();
//$lastInsertId= $conn->lastInsertId();

if($exe){
	$_SESSION['msg'] = "Student data created successfully ";
	header('location:../views/manage_student.php');
}else{
	$_SESSION['error'] = " Something went wrong. Please try again" ;
	echo "<script type='text/javascript'>document.location='../views/manage_student.php'</script>";
}

}
/* end of function to  create student */


/* beggining of deleting class */
function delete_class($class_id) {
	$db = Database::getInstance();
	$conn = $db->getConnection();

	$query = " DELETE FROM tbl_class WHERE class_id =:class_id ";
	$stmt = $conn->prepare( $query );
	$stmt->bindParam(':class_id', $class_id, PDO::PARAM_STR  ) ;
	$stmt->execute() ;
	echo "<script>alert('One class record has been deleted successfully')</script>";
    echo "<script>window.location.href='../view/manage_class.php'</script>";
}

/* ending of deleting class */

/* beggining of deleting subject */
function delete_subject($subject_id) {
	$db = Database::getInstance();
	$conn = $db->getConnection();

	$query = " DELETE FROM tbl_subject WHERE subject_id =:subject_id ";
	$stmt = $conn->prepare( $query );
	$stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_STR  ) ;
	$stmt->execute() ;
	echo "<script>alert('One subject record has been deleted from school subjects ')</script>";
    echo "<script>window.location.href='../view/manage_subject.php'</script>";
}

/* ending of deleting subject */


/* beggining of deleting student */
function delete_student($student_id) {
	$db = Database::getInstance();
	$conn = $db->getConnection();

	$query = " DELETE FROM tbl_student WHERE student_id =:student_id ";
	$stmt = $conn->prepare( $query );
	$stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR  ) ;
	$stmt->execute() ;
	echo "<script>alert('One student record has been deleted from school record ')</script>";
    echo "<script>window.location.href='../view/manage_student.php'</script>";
}

/* ending of deleting student */


}


?>