<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }

if (isset($_GET['subject_id'])) {
    
    $subject_id = $_GET['subject_id'] ;
}else {
    header("location:manage_subject.php") ;
}

$teacher_id = intval($_SESSION['id']) ;
include('../config/DbFunctions.php');
$obj = new DbFunction(); 

// recieve the object returned from the function 

$subject_query =  $obj->show_subject_Byid($subject_id) ;
$sub_result  = $subject_query->fetch(PDO::FETCH_OBJ) ;


// recieve the object returned from the function 

$query =  $obj->show_teacher() ;
$teacher = $query->fetchAll(PDO::FETCH_OBJ) ;

//$teacher_class = $results->class_id;

// use for the select case 
$query2 = $obj->show_class() ;
$class_results = $query2->fetchAll(PDO::FETCH_OBJ);

// get all the subject 
$query3= $obj->show_subject_list() ;
$subj_results = $query3->fetchAll(PDO::FETCH_OBJ);




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
                        <h1 class="page-head-line">EDIT SUBJECT</h1>
                        <h1 class="page-subhead-line">This allows you to add subjecct to   your discipline. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Subjects</li>
                                        <li class="active">Edit Subject</li>
                                    </ul>
                                </div>
                             
                            </div>
                    </div>
                </div>
    


                <!-- /. ROW ENDING  -->


         <!-- /. ROW BEGINNING -->

            <div class="row">
                <div class="col-md-12">
                <div class="panel">
                <div class="panel-heading">

                     <div class="panel-title">
                        <h5> Edit Subbject </h5>
                     </div>
                     <div class="panel-body">
                <div>
            <form class="form-horizontal" method="post"  action="../modal/modal_subject.php?subject_id=<?php echo htmlentities($subject_id);?>">
             <div class="form-group">
                    <label class="control-labbel col-sm-2"> Subject </label>
                    <div class="col-sm-10">
                    <select name="subjectlist_id" class="form-control" id="class_name" required="required">
                    <option value="<?php echo htmlentities($sub_result->subject_id); ?>"> <?php echo htmlentities($sub_result->subject_name); ?>  </option>
                <?php

                if($query3->rowCount() > 0 ){
            foreach ($subj_results as $result) {
                 ?>

                    <option value="<?php echo htmlentities($result->subjectlist_id); ?>" > <?php echo htmlentities($result->subject_name); ?>  </option>
                 <?php 
                    }
                     }
                 ?>

                        </select>
                    </div>
                </div>


  <div class="form-group">
                    <label class="control-labbel col-sm-2"> Class</label>
                    <div class="col-sm-10">

                    <select name="class_id" class="form-control" id="class_name" required="required">
                    <option value="<?php echo htmlentities($sub_result->class_id); ?>"><?php echo htmlentities($sub_result->class_name); ?>  </option>
                <?php

                if($query2->rowCount() > 0 ){
                    foreach ($class_results as $result) {
                 ?>

                    <option value="<?php echo htmlentities($result->class_id); ?>" > <?php echo htmlentities($result->class); ?>  </option>
                 <?php 
                    }
                     }
                 ?>

                        </select>
                    </div>
                </div>


               
  <div class="form-group">
                    <label class="control-labbel col-sm-2"> Who to take subject </label>
                    <div class="col-sm-10">
                    <?php 

$query =  $obj->show_teacher_Byid($sub_result->teacher_id) ;
$results  = $query->fetch(PDO::FETCH_OBJ) ;
$first_name = $results->first_name ;
$last_name =  $results->last_name ;
$teacher = $last_name." ". $first_name ;



                    ?>
                    <select name="teacher_id" class="form-control" id="teacher_id" required="required">
                    <option value="<?php echo htmlentities($sub_result->teacher_id); ?>"><?php echo htmlentities($teacher); ?> </option>
                <?php

                if($query->rowCount() > 0 ){
                    foreach ($teacher as $result) {
                        $first_name = $result->first_name ;
$last_name =  $result->last_name ;
$teacher_name = $last_name." ". $first_name ;
                 ?>

                    <option value="<?php echo htmlentities($result->teacher_id); ?>" > <?php echo htmlentities($teacher_name); ?>  </option>
                 <?php 
                    }
                     }
                 ?>

                        </select>
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="col-sm-2"  style="float: right;" >
                        <button type="submit" name="submit_edit_subject" class="btn btn-success" id="submit_edit_subject" > Submit  </button>
                    </div>
                </div>
            </form>  

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
