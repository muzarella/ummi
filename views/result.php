<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }
$msg = "";
$error = "";

    if (isset($_SESSION['msg']) ){
        $msg = $_SESSION['msg'];
}elseif (isset($_SESSION['error']) ){
    $error =  $_SESSION['error'] ;

}

$teacher_id = $_SESSION['id'] ;

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 
$query1 = $obj-> show_class_teacherid($teacher_id) ;
$result1 = $query1->fetch(PDO::FETCH_OBJ) ;
$class_id = $result1->class_id ;
$query =  $obj-> show_student_Byclassid($class_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;

/*
foreach($results as $row){
 $students[] = array('id'=>$row['student_id'], 'name'=>$row['surname']." ".$row['first_name'], 'gender'=>$row['gender'], ) ;
}
<?php foreach($students as $student ): ?>
<?php echo $student['name'] ;
echo  "<br />". $student['gender'] ;
echo " my data lollll";
 ?>
<?php endforeach; ?>
*/


 ?>

  <?php include('../dist/includes/header.php') ;    ?>
    <div id="wrapper">
      <!-- TOP NAV  -->
      <?php include('../dist/includes/top_bar.php') ;    ?>
        <!-- /. NAV TOP  -->
      <?php include('../dist/includes/left_bar.php') ;    ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

                <!-- /. ROW BEGINNING -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">RESULT UPLOAD</h1>
                        <h1 class="page-subhead-line">This allows you to Upload Score for test and exam for your students. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Result </li>
                                        <li class="active"> Show Student </li>
                                    </ul>
                                </div>
                             
                            </div>
                    </div>
                </div>
                <!-- /. ROW ENDING  -->

         <!-- /. ROW BEGINNING -->
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel">
                <div class="panel-heading">
                     <div class="panel-title">
                        <h5> Manage Student (<span> <?php echo  $query->rowCount(); ?> ) </span> </h5>
                     </div>
                </div>
                     <div class="panel-body">
            <!-- SUCCESS MESSAGE IF SUBMITTED SUCCESSFULLY -->
            <?php 
            if($msg){
            ?> 
                <div class="alert alert-success left-icon-alert" role='alert'>
                    <strong>Well done </strong> 
                    <?php
                        echo htmlentities($msg);
                     ?>
                 </div>
            <?php 
            }elseif($error){
            ?>
            <!-- ERROR MESSAGE IF SUBBMIT NOT SUCCESSUL -->
            
                <div class="alert alert-danger  left-icon-alert" role="alert">

                    <strong>Oh Opss! snap! </strong> 
                    <?php

                        echo htmlentities($error);

                     ?>


                 </div>
        
            <?php 
            }
            ?>
            <!-- beggining of div for table  -->
         <div>
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
                            <a href="add_result.php?student_id=<?php echo htmlentities($student->student_id);?>"> Add scores  <i class="fa fa-edit" title="Edit Record"></i> </a> 
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
          
                     </div>
                </div>

             
            </div>
            </div>
          <!-- /. ROW ENDING  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
         <div id="footer-sec">
        &copy; 2019 Carpet Path int | Design By : Alausa babatunde 
    </div>
    </div>
    <!-- /. WRAPPER  -->
   
    <!-- /. FOOTER  -->
  <?php include('../dist/includes/footer.php') ;    ?>
</body>
</html>
