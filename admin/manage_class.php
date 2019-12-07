<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../../index.php"); 
    }
$msg = "";
$error = "";

    if (isset($_SESSION['update_msg']) ){
        $msg = $_SESSION['update_msg'];
}elseif (isset($_SESSION['update_error']) ){
    $error =  $_SESSION['update_error'] ;

}


include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 
$query =  $obj->show_class() ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;
 ?>
 <?php include('./includes/header.php') ;    ?>
    <div id="wrapper">
      <!-- TOP NAV  -->
      <?php include('./includes/top_bar.php') ;    ?>
        <!-- /. NAV TOP  -->
      <?php include('./includes/left_bar.php') ;    ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

                <!-- /. ROW BEGINNING -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">CLASSES</h1>
                        <h1 class="page-subhead-line">This allows you to Manage class to   your number of class. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> class</li>
                                        <li class="active">Manage Class</li>
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
                        <h5> Manage class </h5>
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
            
                <div class="alert alert-success left-icon-alert" role='alert'>

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
                        <th> Class Name </th>
                        <th> Class Code </th>
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
                        <td><?php echo htmlentities($result->class) ; ?> </td>
                        <td><?php echo htmlentities($result->class_code) ; ?> </td>
                        <td><?php echo htmlentities($result->teacher_assigned) ; ?> </td>
                        <td>
                            <a href="edit_class.php?classid=<?php echo htmlentities($result->class_id);?>"> Edit <i class="fa fa-edit" title="Edit Record"></i> </a> 
                         </td>
                        <td>
                            <a href="../modal/modal_class.php?del_classid=<?php echo htmlentities($result->class_id);?>"> Delete <i class="fa fa-close" title="delete Record"></i> </a> 
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
        <!-- /. PAGE WRAPPER  -->    <div id="footer-sec">
        &copy; 2019 Carpet Path int | Design By : Alausa babatunde 
    </div>
            
    </div>
    <!-- /. WRAPPER  -->

    <!-- /. FOOTER  -->
     <?php include('./includes/footer.php') ;    ?>
</body>
</html>
<?php
 
unset($_SESSION['update_msg']);
unset($_SESSION['update_error']) ;

?>