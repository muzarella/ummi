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

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

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
/** check if users has added student result already  **/  
$check_result = $obj->check_result_if_AlreadyExisting($class_id,$student_id,$session_id, $term_id);

if ($check_result->rowCount() > 0  ){

$query =  $obj->show_result_ByStudent_classid($class_id ,$student_id, $session_id, $term_id) ;
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
                        <td><?php echo htmlentities($result->subject_names ) ; ?> <input type="hidden" name="subject_id[]" value="<?php echo htmlentities($result->subject_id ) ; ?> "  > </td>
                        <td> <input type="number" name="first_test[]"   value="<?php echo htmlentities($result->first_test ) ; ?>" class="form-control" min="0" max="20" required placeholder="Enter first test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="second_test[]"   value="<?php echo htmlentities($result->second_test ) ; ?>" class="form-control"  min="0" max="20" required placeholder="Enter second test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="exam[]"  min="0" max="60"  value="<?php echo htmlentities($result->exam_score ) ; ?>" class="form-control" required placeholder="Enter Exam score " autocomplete="off" >  
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
                        <button type="submit" name="admin_edit_result" class="btn btn-success btn-labeled btn-right" id="submit_edit_subject" > Submit  </button>
                    </div>
                </div>
            
         </div>
        <!-- end of div for  table  -->
<?php 
    }else{
      echo "<div class='col-sm-12' > Sorry there is no subject submitted assigned to this class.       </div>" ;
    }


}else{

  /* if there is result then user wont be able to add result */
echo "<script> alert(' Result not  declared yet kindly add student result first in order to edit any result ')  </script>" ;


  }
?>











