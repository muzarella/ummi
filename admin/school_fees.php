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
$sess =  $obj->get_current_session() ;
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
                        <h1 class="page-head-line"> SESSION </h1>
                        <h1 class="page-subhead-line">This allows you to add a new session to the school calender. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Session</li>
                                        <li class="active">Create Session</li>
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
                        <h5> Create Session </h5>
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
    <h5 style="text-align: center;"><strong> Enter a new session for the school current year.</strong> </h5>

</div><br /><br /><br />

                <div>
   <h5 style="text-align: center;"><strong> Current school session :</strong> <u><b> <span style="color: red;">  <?=$sch_session->session ?> </span>  </b> </u></h5>
            <form class="form-horizontal" method="post"  action="../modal/modal_session.php">
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> New Session </label>
                    <div class="col-sm-6">
                        <input type="text" name="sch_session" class="form-control" id="sch_session" placeholder="Enter New Session  please e.g 1995/1997 " required="required" />
                    </div>
                </div>
               
               
                <div class="form-group has-success">
                    <div class="col-sm-6" style="float: right;">
                        <button type="submit" name="create_session" class="btn btn-info btn-labeled" id="submit_create_class" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
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