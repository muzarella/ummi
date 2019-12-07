<?php 


if(! empty($_POST['class_id'])){
	$class_id = intval($_POST['class_id']) ;
	if(! is_numeric($class_id)){

		echo htmlentities(" invalid class ");
		exit();
	}else {

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

$query =  $obj-> show_student_Byclassid($class_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ)  ;

}

}else {
 echo "<script> alert('sorry no subject could be found please ensure you select a class. ')</script> " ;
 echo "<script> document.location='../admin/manage_subject_comb.php'    </script> " ;

}

?>

          <table class="display table table-striped table-bordered">   
                <thead>
                    <tr>
                        <th># </th>
                        <th> Student Name </th>
                        <th> Student Class </th>
                        <th> Student Gender  </th>
                        <th> Action </th>
                    </tr>
                </thead>
                     <tbody>
        <?php  
        $count = 1;
        if ($query->rowCount() > 0 ){
            foreach($results as $student ){
                $student_name = $student->surname." ".$student->first_name ;
        ?>
                    <tr>
                        <td><?php echo htmlentities($count) ; ?> </td>
                        <td><?php echo htmlentities($student_name) ; ?> </td>
                        <td><?php
 $query2 =  $obj->show_class_Byid($student->class_id) ;
$class= $query2->fetch(PDO::FETCH_OBJ) ;

         echo htmlentities($class->class_code) ; ?> </td>
                        <td><?php echo htmlentities($student->gender) ; ?> </td>
                        <td>
                          <!-- Trigger the modal with a button     onclick="view_student('millz');"    -->
                       	<button class="btn btn-info show_modal"  data-id=<?php echo htmlentities($student->student_id);?>  data-toggle="modal"  data-target="#view_student"> View Details  <i class="fa fa-edit" title="view student Record"></i> </button>
                         </td>
                        <td>
                           <a href="add_result.php?student_id=<?php echo htmlentities($student->student_id);?>" target="_blank" > <button class="btn btn-info"> Add scores  <i class="fa fa-edit" title="Edit Record"></i>  </button></a>
                        </td>
                         <td>
                          <!-- Trigger the modal with a button     onclick="view_student('millz');"    -->
                        <button class="btn btn-info show_modal_result"  data-id=<?php echo htmlentities($student->student_id);?>  data-toggle="modal"  data-target="#add_result"> Add results  <i class="fa fa-edit" title="add student Result"></i> </button>
                         </td>
                   </tr>
                   <?php 
                   $count = $count +1 ;
                    } }
                   ?>
                </tbody>
            </table>