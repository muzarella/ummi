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
$query = $obj->show_date_details() ;
$result = $query->fetch(PDO::FETCH_OBJ);
 
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
                        <h1 class="page-head-line"> DATES </h1>
                        <h1 class="page-subhead-line">This allows you to update date for school resumption and vacation. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> School Date </li>
                                        <li class="active"> Update Resumption date / Vacation date </li>
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
                        <h5> Create Date  </h5>
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
<!-- begginging of form div  -->
                <div class="col-md-12" >

            <form class="form-horizontal" method="post"  action="../modal/modal_dates.php">
<fieldset>
    <h5 style="text-align: center;"><strong> Vacation date for last term &nbsp;:<span style="color: red;"> <?= $result->vacation_date ; ?> </span> </strong> </h5>
<legend> <h5 style="text-align: center;"><strong> Enter the vacation date for this current session. </strong> </h5></legend>

<br /><br /><br />

                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Vacation date for this term  </label>
                    <div class="col-sm-10">
                        <input type="text" name="vacation" class="form-control" id="sch_session" placeholder="Enter vacation date " required="required" />
                    </div>
                </div>
               
               
                <div class="form-group has-success">
                    <div class="col-sm-2" style="float: right;">
                        <button type="submit" name="vacation_date" class="btn btn-info btn-labeled" id="submit_create_class" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
                    </div>
                </div>
                </fieldset>

            </form>  

  </div>

  <!-- ending of form div  -->
<br /><br /><br />

<!-- begginging of form div  -->
                <div class="col-md-12" >

            <form class="form-horizontal" method="post"  action="../modal/modal_dates.php">
<fieldset>
    <h5 style="text-align: center;"><strong>  Resumption date for this current term is &nbsp;: <span style="color: red;"><?= $result->resumption_date ; ?></span>. </strong> </h5>
<legend> <h5 style="text-align: center;"><strong> Enter Resumption date for the next term to come . </strong> </h5></legend>

<br /><br /><br />

                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Resumption  date for next term  </label>
                    <div class="col-sm-10">
                <input type="text" name="resumption" class="form-control" id="resumption" placeholder="Enter Resumption date for next term" required="required" />
                    </div>
                </div>
               
               
                <div class="form-group has-success">
                    <div class="col-sm-2" style="float: right;">
                        <button type="submit" name="resumption_date" class="btn btn-info btn-labeled" id="submit_resumption" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
                    </div>
                </div>
</fieldset>

            </form>  

  </div>

  <!-- ending of form div  -->

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