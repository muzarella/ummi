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



if(isset($_GET['session_id'])){
$sid = intval($_GET['session_id']) ;
}else{
    header("location:manage_session.php");
}


include('../config/DbFunctions.php');
$obj = new DbFunction(); 

// recieve the class object to be edited 
$session_query = $obj->show_session_Byid( $sid ) ;
 $result = $session_query->fetch(PDO::FETCH_OBJ);

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
                        <h1 class="page-head-line">EDIT  SESSION </h1>
                        <h1 class="page-subhead-line">This allows you to edit a given session of the school calender. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Session</li>
                                        <li class="active">Edit Session</li>
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
                        <h5> Edit Session </h5>
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
    <h5 style="text-align: center;"><strong> Edit this session for the school year.</strong> </h5>

</div><br /><br /><br />

                <div>

            <form class="form-horizontal" method="post"  action="../modal/modal_session.php?session_id=<?php echo htmlentities($sid) ; ?>">
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Edit Session </label>
                    <div class="col-sm-10">
                        <input type="text" name="sch_session" class="form-control" id="sch_session" value="<?=$result->session  ?>" placeholder="Enter New Session  please e.g 1995/1997 " required="required" />
                    </div>
                </div>
               
               
                <div class="form-group has-success">
                    <div class="col-sm-2" style="float: right;">
                        <button type="submit" name="edit_session" class="btn btn-info btn-labeled" id="edit_session" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
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