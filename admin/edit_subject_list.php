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


if(isset($_GET['subject_id'])){
$sid = intval($_GET['subject_id']) ;

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the subject object to be edited 
$class_query = $obj->show_subjectlist_Byid( $sid ) ;
 $result = $class_query->fetch(PDO::FETCH_OBJ);

}else{
    header("location:manage_class.php");
}

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
                        <h1 class="page-head-line">Subject</h1>
                        <h1 class="page-subhead-line">This allows you to add new subject to   your number of subject list. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> class</li>
                                        <li class="active">Create Subject</li>
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
                        <h5> Create subject </h5>
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

            <form class="form-horizontal" method="post"  action="../modal/modal_subject.php?subject_id=<?php echo htmlentities($result->subjectlist_id);?> ">
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Subject Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="subject_name" class="form-control" id="subject_name" value="<?php echo htmlentities($result->subject_name) ; ?>" placeholder="Enter subject name please e.g Mathematics " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Subject short Code</label>
                    <div class="col-sm-10">
                        <input type="text" name="subject_code" class="form-control" id="subject_code" value="<?php echo htmlentities($result->subject_code) ; ?>" placeholder="Enter subject code e.g Math  " required="required" />
                    </div>
                </div>
                
                <div class="form-group has-success">
                    <div class="col-sm-2" style="float: right;" >
                        <button type="submit" name="edit_subject_List" class="btn btn-success btn-labeled" id="submit_create_class" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
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
    <?php include('./includes/footer.php') ;    ?>
    


</body>
</html>
<?php
unset($_SESSION['msg']);
unset($_SESSION['error']) ;
?>