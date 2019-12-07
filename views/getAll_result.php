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

        echo htmlentities(" invalid student assigned");
        exit();
    }
}

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

$query =  $obj->show_result_ByStudent_classid($class_id ,$student_id) ;
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
                        <td><?php echo htmlentities($result->subject_names ) ; ?> </td>
                        <td> <input type="number" name="first_test[]"   value="<?php echo htmlentities($result->first_test ) ; ?>" class="form-control" min="0" max="20" required="" placeholder="Enter first test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="second_test[]"   value="<?php echo htmlentities($result->second_test ) ; ?>" class="form-control"  min="0" max="20" required="" placeholder="Enter second test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="exam[]"  min="0" max="60"  value="<?php echo htmlentities($result->exam_score ) ; ?>" class="form-control" required="" placeholder="Enter Exam score " autocomplete="off" >  
                         </td>
                   </tr>
                 
<?php 
  $count = $count +1 ;
endforeach;
		}else{
      echo " Please contact your admin in order to make changes to this result" ;
    }
	
?>
                </tbody>
            </table>
         </div>
        <!-- end of div for  table  -->

