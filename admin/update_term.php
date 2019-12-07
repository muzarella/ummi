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
$query =  $obj->show_term() ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;

$sess =  $obj->get_current_term() ;
$sch_session = $sess->fetch(PDO::FETCH_OBJ) ;
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
                        <h1 class="page-head-line"> TERM </h1>
                        <h1 class="page-subhead-line">This allows you to update the current TERM to the school session. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Term </li>
                                        <li class="active">Update School Term </li>
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
                        <h5> Update Term </h5>
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
<div class="col-md-12" >
    <h5 style="text-align: center;"><strong> Current school Term : </strong> <u><b> <span style="color: red;">  <?=$sch_session->term ?> </span>  </b> </u></h5>

</div><br /><br /><br />
                <div class="col-md-12">

            <form class="form-horizontal" method="post"  action="../modal/modal_session.php">
                
                 <div class="form-group">
                    <label class="control-labbel col-sm-4"> Update school current term </label>
                    <div class="col-sm-6">
                    <select name="sch_term" class="form-control" id="assigned_teacher" required="required">
                    <option value="">School current Term </option>
                <?php

                if($query->rowCount() > 0 ){
                    foreach ($results as $result) {
                 ?>

                    <option value="<?php echo htmlentities($result->term_id); ?>" > <?php echo htmlentities($result->term); ?> </option>
                 <?php 
                    }
                     }
                 ?>

                        </select>
                    </div>
                </div>
               
                <div class="form-group has-success">
                    <div class="col-sm-6" style="float: right;">
                        <button type="submit" name="update_term" class="btn btn-info btn-labeled" id="update_term" onclick="confirm('are you sure you want to update current school Term')" > Update <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
                    </div>
                </div>
            </form>  


            </div>
            </div>
            </div>
          <!-- /. ROW ENDING  -->
            </div>
            <!-- /. PAGE INNER  -->
            <div id="footer-sec">
        &copy; 2019 Carpet Path int | Design By : Alausa babatunde 
        </div>
            
        </div>
        <!-- /. PAGE WRAPPER  -->
        
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