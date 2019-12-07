
<?php 
//$student_id =1 ;

if (isset($_POST['id'] )) {
$stu_id = $_POST["id"] ;

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

try{
$query = $obj->show_student_Byid($stu_id);
$student = $query->fetch(PDO::FETCH_OBJ);
}catch(Exception $e){
 echo 'Message result error: ' .$e->getMessage();
}

try{
$query_class = $obj->show_class_Byid( $student->class_id ) ;
$get_class = $query_class->fetch(PDO::FETCH_OBJ);
}catch(Exception $e){
 echo 'Message result error: ' .$e->getMessage();
}

$data =[] ;

$row =$query->rowCount() ;
if ($row > 0 ) {
//echo $row ;

//foreach ($students as $student) {
 $name =$student->surname." ".$student->first_name;
 $class = $get_class->class ;
array_push($data, array(
"student_id"=>$student->student_id,
"name"=> $name,
"class"=>$class,
"gender"=>$student->gender,
"parent_name"=>$student->guardian_name,
"parent_phone" =>$student->guardian_phone,
"dob"=>$student->dob,
"parent_address"=>$student->address,
"image"=>$student->image 
) ) ;
//}
     
echo json_encode(array(
"response" => 200,
"message" => "Connected Successfuly",
"data" => $data
    ));


}else {
 echo json_encode(array(
"response" => 201,
"message" => "No content Posted yet",
"data" => []
        ));

}


}else{
     echo json_encode(array(
 "response" => 409,
"message" => "Unauthorized"
            ));
}

?>