<?php 

if(! empty($_GET['class_id'] )){
	$class_id = intval($_GET['class_id']) ;
	if(! is_numeric($class_id)){

		echo htmlentities(" invalid class ");
		exit();
	}
}
if(! empty($_GET['student_id'] )){
        $student_id = intval($_GET['student_id']) ;
    if(! is_numeric($student_id)){

        echo htmlentities(" invalid  teacher assigned");
        exit();
    }
}

/*echo "class id =".$class_id;
echo "teacher_id=".$teacher_id ;*/
include('../config/DbFunctions.php');
$obj = new DbFunction(); 


/** check if users has added student result already  **/  


// to get session of the year  
try{
$session_query =  $obj->get_current_session() ;
$session_result  = $session_query->fetch(PDO::FETCH_OBJ) ;
$session_id = $session_result->session_id ;
}catch(Exception $e){
 echo 'Message population of student error: ' .$e->getMessage();
}
// end of getting session of the year  


// to get term of the year  
try{
$term_query =  $obj->get_current_term() ;
$term_result  = $term_query->fetch(PDO::FETCH_OBJ) ;
$term_id = $term_result->term_id;

}catch(Exception $e){
 echo 'Message population of student error: ' .$e->getMessage();
}
// end of getting term of the year

/*echo "student ".$student_id ;
echo " session id ".$session_id ;
echo " term_id". $term_id ;
*/
$check_result = $obj->check_result_if_AlreadyExisting($class_id,$student_id,$session_id, $term_id);


if ($check_result->rowCount() > 0  ){

  /* if there is result then user wont be able to add result */
echo "<script> alert(' Result already declared kindly go to view inorder to edit or show this result ')  </script>" ;

}else{
$query =  $obj->show_subject_ByClassid($class_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;
?>


   <!-- beggining of div for table  -->
         <div class="col-sm-12">
            <table class="display table table-striped table-bordered">   
                <thead>
                    <tr>
                        <th># </th>
                        <th> Subject Name  </th>
                        <th> First Test Score </th>
                        <th> Second Test Score  </th>
                        <th> Exam Score  </th>
                    </tr>
                </thead>
                   <tbody>

<?php 
 $count = 1;
if ($query->rowCount() > 0 ){
foreach ($results as $result) : ?>
                  
                    <tr>
                        <td><?php echo htmlentities($count) ; ?> </td>
                        <td><?php echo htmlentities($result->subject_name ) ; ?> <input type="hidden" name="subjectlist_id[]" value="<?php echo htmlentities($result->subjectlist_id ) ; ?>" class="form-control" required >  </td>

                        <td> <input type="number" name="first_test[]"   value="" class="form-control" min="0" max="20" required placeholder="Enter first test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="second_test[]"   value="" class="form-control"  min="0" max="20" required placeholder="Enter second test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="exam[]"  min="0" max="60"  value="" class="form-control" required placeholder="Enter Exam score " autocomplete="off" >  
                         </td>
                   </tr>
                 
<?php 
  $count = $count +1 ;
endforeach;

?>
                </tbody>
            </table>
<div class="form-group">
                    <div class="col-sm-2">
                        <button type="submit" name="admin_submit_result" class="btn btn-success btn-labeled btn-right" id="submit_edit_subject" > Submit  </button>
                    </div>
                </div>
            
         </div>
        <!-- end of div for  table  -->
<?php 
		}else{
      echo "<div class='col-sm-12' > Sorry there is no subject assigned to this class.       </div>" ;
    }
	}
?>

