<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }
$msg = "";
$error = "";

    if (isset($_SESSION['class_msg']) ){
        $msg = $_SESSION['class_msg'];
}elseif (isset($_SESSION['class_error']) ){
    $error =  $_SESSION['class_error'] ;

}



include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 
$query =  $obj->show_teacher() ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;


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
                        <h1 class="page-head-line">CLASSES</h1>
                        <h1 class="page-subhead-line">This allows you to add class to   your number of class. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> class</li>
                                        <li class="active">Create Class</li>
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
                        <h5> Create class </h5>
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
                        

                     

                </div>

                </div>

                <div>

            <form class="form-horizontal" method="post"  action="../modal/modal_class.php">
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> class Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="class_name" class="form-control" id="class_name" placeholder="Enter class name please e.g PRIMARY 1 " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Class short Code</label>
                    <div class="col-sm-10">
                        <input type="text" name="class_code" class="form-control" id="class_code" placeholder="Enter class code e.g  PRY 1 " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Assigned Teacher to class</label>
                    <div class="col-sm-10">
                    <select name="assigned_teacher" class="form-control" id="assigned_teacher" required="required">
                    <option value="">Select teacher to handle class </option>
                <?php

                if($query->rowCount() > 0 ){
                    foreach ($results as $result) {
                 ?>

                    <option value="<?php echo htmlentities($result->teacher_id); ?>" > <?php echo htmlentities($result->last_name); ?> &nbsp; <?php echo htmlentities($result->first_name); ?> </option>
                 <?php 
                    }
                     }
                 ?>

                        </select>
                    </div>
                </div>
                <div class="form-group has-success">
                    <div class="col-sm-2">
                        <button type="submit" name="submit_create_class" class="btn btn-info btn-labeled" id="submit_create_class" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
                    </div>
                </div>



            </form>  

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
<?php
unset($_SESSION['class_msg']);
unset($_SESSION['class_error']) ;
?>