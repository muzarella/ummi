<?php 

if(! empty($_POST['class_id'])){
	$class_id = intval($_POST['class_id']) ;
	if(! is_numeric($class_id)){

		echo htmlentities(" invalid class ");
		exit();
	}else {

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

$query =  $obj-> show_subject_ByClassid($class_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;

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
                        <th> Class </th>
                        <th> Subject </th>
                        <th> Subject code </th>
                        <th> Teacher Assigned </th>
                        <th> Action </th>
                    </tr>
                </thead>
                     <tbody>
        <?php  
        $count = 1;
        if ($query->rowCount() > 0 ){
            foreach($results as $result ){
        ?>
                    <tr>
                        <td><?php echo htmlentities($count) ; ?> </td>
                        <td><?php echo htmlentities($result->class_name) ; ?> </td>
                        <td><?php echo htmlentities($result->subject_name) ; ?> </td>
                        <td><?php echo htmlentities($result->subject_code) ; ?> </td>
        <?php 
            $teacher_id = $result->teacher_id ;
            $query2 =$obj->show_teacher_Byid($teacher_id) ;
            $teacher = $query2->fetch(PDO::FETCH_OBJ) ;

            $first_name = $teacher->first_name ;
            $last_name =  $teacher->last_name ;
            $teacher_name = $last_name." ". $first_name ;

           /* foreach ($teacher_name as $teacher ) {
            

            }
*/
        ?>
                        <td><?php echo htmlentities($teacher_name) ; ?> </td>
                        <td>
                            <a href="edit_subject_comb.php?subject_id=<?php echo htmlentities($result->subject_id);?>"> Edit  </a> <i class="fa fa-edit" title="Edit Record"></i>
                         </td>
                        <td>
                            <a href="../modal/modal_subject.php?del_classid=<?php // echo htmlentities($result->subject_id);?>"> Delete </a>  <i class="fa fa-close" title="delete Record"></i>
                        </td>
                   </tr>
                   <?php 
                   $count = $count +1 ;
                    } }
                   ?>
                </tbody>
            </table>

