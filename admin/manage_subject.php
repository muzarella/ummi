<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../../index.php"); 
    }
$msg = "";
$error = "";

    if (isset($_SESSION['msg']) ){
        $msg = $_SESSION['msg'];
}elseif (isset($_SESSION['error']) ){
    $error =  $_SESSION['error'] ;

}


include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 
$query =  $obj->show_subject_list() ;
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
                        <h1 class="page-head-line"> SUBJECT </h1>
                        <h1 class="page-subhead-line">This allows you to Manage subject to   your number of subject list. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> class</li>
                                        <li class="active">Manage Subject List </li>
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
                        <h5> Manage subject  list </h5>
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
                        <th> subject Name </th>
                        <th> Class Code </th>
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
                        <td><?php echo htmlentities($result->subject_name) ; ?> </td>
                        <td><?php echo htmlentities($result->subject_code) ; ?> </td>
                        <td>
                            <a href="edit_subject_list.php?subject_id=<?php echo htmlentities($result->subjectlist_id);?>"> Edit <i class="fa fa-edit" title="Edit Record"></i> </a> 
                         </td>
                        <td>
                            <a href="../modal/modal_subject.php?del_subjectid=<?php echo htmlentities($result->subjectlist_id);?>"> Delete <i class="fa fa-close" title="delete Record"></i> </a> 
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
     <?php include('./includes/footer.php') ;    ?>
</body>
</html>
<?php
 
unset($_SESSION['msg']);
unset($_SESSION['error']) ;

?>