<?php 
session_start();

if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }else {

if (isset($_POST['create_session'])){

 $session = $_POST['sch_session'] ;
 if (!empty($session)){

include('../config/DbFunctions.php');
$obj = new DbFunction();

$obj->create_session($session) ;



 }else{
 	echo "<script> alert('No session for school year  decleared') </script>" ;
 }


}



if (isset($_POST['edit_session'])){


if (!empty($_POST['sch_session'] )){
$session = $_POST['sch_session'] ;

 }else{
echo "<script> alert('Kindly ensure that your  session for school year is   decleared') </script>" ;
 }


if (isset( $_GET['session_id'] )){
$session_id = intval($_GET['session_id']) ;
 if (!empty($session_id)){

include('../config/DbFunctions.php');
$obj = new DbFunction();

$obj->update_session($session_id, $session ) ;

 }else{
 	echo "<script> alert('No session id  for school year  decleared') </script>" ;
 }

}else {
	echo "<script> alert('No session for school year  decleared') </script>" ;
}





}



if (isset($_POST['update_session'])){

 $session_id = $_POST['sch_session'] ;
 if (!empty($session_id)){

include('../config/DbFunctions.php');
$obj = new DbFunction();

 $query = $obj->get_session_Byid($session_id) ;
$session = $query->fetch(PDO::FETCH_OBJ); 
$session_date = $session->session ;

$obj->update_current_session($session_id, $session_date ) ;

 }else{
 	echo "<script> alert('No session for school year  decleared') </script>" ;
 }


}

//  update_term of the ccurrent school session 


if (isset($_POST['update_term'])){

 $term_id = $_POST['sch_term'] ;
 if (!empty($term_id)){

include('../config/DbFunctions.php');
$obj = new DbFunction();

 $query = $obj->get_term_Byid($term_id) ;
$term_name = $query->fetch(PDO::FETCH_OBJ); 
$term = $term_name->term ;

$obj->update_current_term($term_id, $term ) ;

 }else{
 	echo "<script> alert('No session for school year  decleared') </script>" ;
 }


}


}


?>