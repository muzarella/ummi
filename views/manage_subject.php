<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }
$msg = "";
$error = "";

    if (isset($_SESSION['update_msg']) ){
        $msg = $_SESSION['update_msg'];
}elseif (isset($_SESSION['update_error']) ){
    $error =  $_SESSION['update_error'] ;

}
$teacher_id = $_SESSION['id']  ;
include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 
$query =  $obj->show_subject_ByteacherId($teacher_id) ;
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
                        <h1 class="page-head-line">SUBJECT</h1>
                        <h1 class="page-subhead-line">This allows you to Manage Subject to   your number of subject list. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Subject </li>
                                        <li class="active">Manage subject</li>
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
                        <h5> Manage subject </h5>
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
            <!-- select the class so as to shhow subject  -->
             <div class="form-group">
                    <label class="control-labbel col-sm-2"> Select class to view subject </label>
                    <div class="col-sm-10">
                       <select name="class_id" class="form-control" id="class_name"  required="required" onchange="get_subject(this.value); " >
                    <option value=""> Select class</option>
                <?php

                if($query->rowCount() > 0 ){
                    foreach ($results as $result) {
                 ?>
                    <option value="<?php echo htmlentities($result->class_id); ?>" > <?php echo htmlentities($result->class_name); ?>  </option>
                 <?php 
                    }
                     }
                 ?>
                        </select>
                    </div>
                </div>

            <!-- end -->
             <!-- beggining of div for table  -->
         <div id="all_subject">
         </div>
        <!-- end of div for  table  --> 
          
          
                     </div>
                </div>

             </div>
         </div>

            
          <!-- /. ROW ENDING  -->
            </div>
            <!-- /. PAGE INNER  -->

    <!-- /. FOOTER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->

             <div id="footer-sec">
        &copy; 2019 Carpet Path int | Design By : Alausa babatunde 
    </div>
    </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
 <?php include('../dist/includes/footer.php') ;    ?>
    <script type="text/javascript">
        
      /*    $(document).on("change", ".get_subject",function(){
        var val = $(this).data('id') ;
    //    window.alert(val);
        get_subject(val) ;

       })*/

  function get_subject (val){
      // alert("hello world ");
            $.ajax({
                type:"POST",
                url:"getclass_subject.php",
                data: 'class_id='+ val,
                success: function(data){
                    $('#all_subject').html(data) ;
                }


            })
// $('.get_subject').hide();
        }

    </script>
</body>
</html>
<?php 
unset ($_SESSION["update_msg"]);
unset($_SESSION['update_error']);
?>

