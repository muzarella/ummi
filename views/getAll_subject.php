<?php 

if(! empty($_GET['class_id'] )){
	$class_id = intval($_GET['class_id']) ;
	if(! is_numeric($class_id)){

		echo htmlentities(" invalid class ");
		exit();
	}
}
if(! empty($_GET['teacher_id'] )){
        $teacher_id = intval($_GET['teacher_id']) ;
    if(! is_numeric($teacher_id)){

        echo htmlentities(" invalid  teacher assigned");
        exit();
    }
}

/*echo "class id =".$class_id;
echo "teacher_id=".$teacher_id ;*/
include('../config/DbFunctions.php');
$obj = new DbFunction(); 

$query =  $obj->show_subject_By_class_teacher($class_id ,$teacher_id) ;
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
                        <td> <input type="number" name="first_test[]"   value="0" class="form-control" min="0" max="20" required="" placeholder="Enter first test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="second_test[]"   value="0" class="form-control"  min="0" max="20" required="" placeholder="Enter second test score" autocomplete="off" >  </td>
                        <td> <input type="number" name="exam[]"  min="0" max="60"  value="0" class="form-control" required="" placeholder="Enter Exam score " autocomplete="off" >  
                         </td>
                   </tr>
                 
<?php 
  $count = $count +1 ;
endforeach;
		}
	
?>
                </tbody>
            </table>
         </div>
        <!-- end of div for  table  -->

