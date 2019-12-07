<?php 

if(! empty($_POST['class_id'])){
	$class_id = intval($_POST['class_id']) ;
	if(! is_numeric($class_id)){

		echo htmlentities(" invalid class ");
		 echo "<script> alert('Please contact your admin in order to manage student'); </script>";
    echo "<script type='text/javascript'>document.location='../admin/index.php'</script>";
		exit();
	}else {

include('../config/DbFunctions.php');
$obj = new DbFunction(); 

try{

$query =  $obj-> show_student_Byclassid($class_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;

}catch(Exception $e){
 echo 'Message: ' .$e->getMessage();
}

}

}
?>
<br />
 <!-- beggining of div for table  -->
         <div>

         	 <h5> Total Student (<span> <?php echo  $query->rowCount(); ?> ) </span> </h5>
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
                           <!-- <a href="edit_student.php?student_id=<?php // echo htmlentities($student->student_id);?>"> Edit <i class="fa fa-edit" title="Edit Record"></i> </a> --> 
                         </td>
                        <td>
                          <!--   <a class="btn btn-block  btn-social btn-adn"  href="../modal/modal_student.php?student_id=<?php // echo htmlentities($student->student_id);?>"> Delete <i class="fa fa-close" title="delete Record"></i> </a>  -->
                        </td>
                   </tr>
                   <?php 
                   $count = $count +1 ;
                    } }
                   ?>
                </tbody>
            </table>
         </div>
        <!-- end of div for  table  -->
