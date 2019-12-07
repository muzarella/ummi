<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }

$msg = "";
$error = "";

    if (isset($_SESSION['msg']) ){
        $msg = $_SESSION['msg'];
}elseif (isset($_SESSION['error']) ){
    $error =  $_SESSION['error'] ;

}

if(! empty($_GET['class_id'] )){
    $class_id = intval($_GET['class_id']) ;
    if(! is_numeric($class_id)){

        echo htmlentities(" invalid class ");
        exit();
    }
}
if(! empty($_GET['student_id'] )){
        $student_id = intval($_GET['student_id']) ;
    if(! is_numeric($student_id)){

        echo htmlentities(" invalid student assigned");
        exit();
    }
}
// recieve the object returned from the function 
include('../config/DbFunctions.php');
$obj = new DbFunction(); 

// get the result details all score and subject
try{

$query =  $obj->show_result_ByStudent_classid($class_id ,$student_id) ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;

}catch(Exception $e){
 echo 'Message result error: ' .$e->getMessage();
}

// get student detail
try{
$student_query = $obj->show_student_Byid( $student_id ) ;
$student = $student_query->fetch(PDO::FETCH_OBJ ) ;
}catch(Exception $e){
 echo 'Message student error: ' .$e->getMessage();
}

// get class 
try{
$class_query = $obj->show_class_Byid( $class_id ) ;
$class = $class_query->fetch(PDO::FETCH_OBJ ) ;
}catch(Exception $e){
 echo 'Message student error: ' .$e->getMessage();
}
//end of get class 

// to get student totall  population 
try{
$population_query =  $obj->show_student_Byclassid($class_id) ;
//$population_results  = $population_query->fetchAll(PDO::FETCH_OBJ) ;
}catch(Exception $e){
 echo 'Message population of student error: ' .$e->getMessage();
}
// end of getting student population 

// to get session of the year  
try{
$session_query =  $obj->get_current_session() ;
$session_result  = $session_query->fetch(PDO::FETCH_OBJ) ;
}catch(Exception $e){
 echo 'Message population of student error: ' .$e->getMessage();
}
// end of getting session of the year  


// to get term of the year  
try{
$term_query =  $obj->get_current_term() ;
$term_result  = $term_query->fetch(PDO::FETCH_OBJ) ;
}catch(Exception $e){
 echo 'Message population of student error: ' .$e->getMessage();
}
// end of getting term of the year  



//to get student name 
$student_name = $student->surname." ".$student->first_name ;

function grade($mark){

$calculate = $mark;

if ( $calculate === 0 || $calculate <=39   ) {
    echo "E";
} else if ($calculate === 40 || $calculate <=49  ) {
    echo "D";
} else if ($calculate === 50 || $calculate <=59  ) {
    echo "C";
} else if ($calculate === 60 || $calculate <=74  ) {
    echo "B";
}  else if ( $calculate === 75 || $calculate <=100 ) {
    echo "A";
}   
}


function remark($mark){

$calculate = $mark;

if ( $calculate === 0 || $calculate <=39   ) {
    echo "Fail";
} else if ($calculate === 40 || $calculate <=49  ) {
    echo "Pass";
} else if ($calculate === 50 || $calculate <=59  ) {
    echo "Good";
} else if ($calculate === 60 || $calculate <=74  ) {
    echo "V.Good";
}  else if ( $calculate === 75 || $calculate <=100 ) {
    echo "Excellent";
}   
}

function position (){

}

 ?>
<?php
/*echo "Enter the number";
$num=trim(fgets(STDIN));
if($num>=59 && $num<=79){
   echo "You win";
}else{
   echo "You loss";
}*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> ummmi</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="../assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style type="text/css">
        p{
            font-size: 12px;
        }

        table td{
            font-size: 12px;
        }

    </style>

</head>
<body>
    <div id="wrapper">
    

        <div id="-wrapper">
            <div id="page-inner">

                <!-- /. ROW BEGINNING -->
                <div class="col-md-8">
                    <div class="row">
                    <div class="col-sm-2">
                       <img src="<?php // echo " $student->image" ; ?>" class="col-sm-4 img-responsive" id="img_size" alt="student image" />
                    </div>
                    <div class="col-md-8">
                        <h3 class="page-head-line"><center> UMMI INTERNATIONAL SCHOOL</center> </h3>    
                    </div>
                   </div>
                    <div class="row"><center>
 <p class="page-subhead-line">
No 20, Okada Road,P.O Box 490,Minna Niger State;&nbsp;&nbsp; 08138665441,07035379946;&nbsp;&nbsp;ummiinternationalschool@info.edu.ng,www.ummiinternationalschool.edu.ng
                         </p> </center>
                </div>
                </div>
                <!-- /. ROW ENDING  -->
                
         <!-- /. ROW BEGINNING -->
            <div class="row">
                <div class="col-sm-12">
                <div class="panel panel-primary">
                <div class="panel-heading">
                     <div class="panel-title">
                        <h5><center> <strong>TERMINAL REPORT SHEET FOR <?php  echo htmlentities($session_result->session) ;  ?> ACADEMIC SESSION </strong> </center></h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <p><strong> Name:&nbsp; <?php echo $student_name ?></strong></p>
                                <p><strong> Gender: &nbsp;<?php echo $student->gender; ?> </strong> &nbsp;&nbsp;&nbsp; <strong>  Class: &nbsp;<?php  echo $class->class; ?></strong> </p>
                                <p><strong>Class population:&nbsp; <?php echo  $population_query->rowCount(); ?>  </strong>  </p>
                            </div>
                            <div class="col-sm-4">
                              <p>   <strong>Term:&nbsp; <?php  echo htmlentities($term_result->term) ;  ?> </strong></p>
                              <p> <strong> Vacation Date:&nbsp;  Nill </strong> </p>
                               <p> <strong>Resumption Date:&nbsp; Nill </strong> </p>
                            </div>
                            <div class="col-sm-2">
                                 <img src="<?php //echo " $student->image" ; ?>" class="col-sm-4 img-responsive" id="img_size" alt="student image" />
                            </div>
                            <div class="col-sm-8">
                             <p> Max.Attendance: ____ Time(s) Present: _____ Absent:____  &nbsp;&nbsp;&nbsp;<strong> Position in class:&nbsp;  </strong>  </p> </div>
                        </div>
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
            
                <div class="alert alert-danger left-icon-alert" role='alert'>

                    <strong>Oh Opss! snap! </strong> 
                    <?php

                        echo htmlentities($error);

                     ?>
                 </div>
            <?php 
            }
            ?>
        <center><h6><strong> COGNITIVE DOMAIN</strong></h6></center>
            <!-- beggining of div for table  -->
         <div>
            <table class="display table table-striped table-bordered">   
                <thead>
                    <tr>
                        <th>S/NO</th>
                        <th> Subjects </th>
                        <th> 1st CA </th>
                        <th> 2nd CA  </th>
                        <th> Total CA </th>
                        <th> Exam Score </th>
                        <th> Total  </th>
                        <th> Position </th>
                        <th> Grade </th>
                        <th> Remarks </th>
                    </tr>
                </thead>
                     <tbody>
        <?php  
        $count = 1;
        if ($query->rowCount() > 0 ){
              $total = 0 ;
            foreach($results as $result ){

        ?>
                    <tr>
                        <td><?php echo htmlentities($count) ; ?> </td>
                        <td><?php echo htmlentities($result->subject_names) ; ?> </td>
                        <td><?php
         echo htmlentities($result->first_test) ; ?> </td>
                        <td><?php echo htmlentities($result->second_test) ; ?> </td>
                        <td>
                            <?php 
                            $test_total= $result->first_test + $result->second_test ;
                            echo htmlentities($test_total );
                            ?>
                           
                         </td>
                         <td><?php echo htmlentities($result->exam_score) ; ?> </td>
                         <td>
                            <?php
                             $exam = $result->exam_score;
                             $exam_total = $exam + $test_total ;
                              echo htmlentities($exam_total );
                            ?>
                           
                         </td>
                         <td>
                           <?php 

                           //position($exam_total);
                           ?>
                         </td>
                         <td>
                            <?php 

                           grade($exam_total);
                           ?>
                         </td>
                         <td>
                           <?php 

                           remark($exam_total);
                           ?>

                         </td>
                
                   </tr>
                   <?php 
                    $total += $exam_total;
                   $count = $count +1 ;
                    } }
                   ?>
                   <tr><td colspan="10"> &nbsp;&nbsp;&nbsp;
                    TOTAL SUBJECT =  <?php 
                    $cnt =  $count -1 ;
                        echo $cnt;

                           ?>  &nbsp;&nbsp;&nbsp;  
                    TOTAL OBTAINED = <?php 
                        echo $total ;

                           ?> &nbsp;&nbsp;&nbsp;   AVERAGE = <?php 
                      $average = $total /$cnt ; 
                        echo round($average, 1 ). "%" ;
                           ?> </td> </tr>
                </tbody>
            </table>

            <table class="display table table-striped table-bordered" >
                <center> <h6><strong>AFFECTIVE & PSYCHOMOTOR DOMAINS </h6></strong></center>
                <thead>
                    <tr><th> </th>
                        <th>Grade </th>
                        <th> </th>
                        <th> Grade</th>
                        <th> </th>
                        <th>Grade </th>


                     </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td> PUNCTUALITY</td>
                        <td> </td>
                        <td> ATTENDANCE IN CLASS </td>
                        <td>  </td>
                        <td> PERSONAL HYGINE </td>
                        <td>  </td>
                    <tr>
                    <tr> 
                        <td> PUNCTUALITY</td>
                        <td> </td>
                        <td> ATTENDANCE IN CLASS </td>
                        <td>  </td>
                        <td> PERSONAL HYGINE </td>
                        <td>  </td>
                    <tr>
                    <tr> 
                        <td> PUNCTUALITY</td>
                        <td> </td>
                        <td> ATTENDANCE IN CLASS </td>
                        <td>  </td>
                        <td> PERSONAL HYGINE </td>
                        <td>  </td>
                    <tr>
                </tbody>
                <tfoot>
                    
                </tfoot>

            </table>
            <hr>
            <p><center> SCHOOL FEES FOR NEXT TERM NN </center>
            <hr>
         </div>
         <div class="row">
            <div class="col-sm-4">
               <p> Class Teacher's Name:</p>
               <p class="col-md-2"><u>Comments  </u></p>
               <br />
               <p  class="col-md-2"> Signature/Date</p> 
            </div>
            <div class="col-sm-4">
                <p> Class Teacher's Name:</p>
               <p class="col-md-2"><u>Comments  </u> </p>
               <br />
               <p  class="col-md-2"> Signature/Date</p>  
            </div >
            
         </div>
                 
                     </div>
                </div>

             
            </div>
            </div>
          <!-- /. ROW ENDING  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        &copy; 2019 Carpet Path int | Design By : Alausa babatunde 
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
</body>
</html>

<?php 
unset($_SESSION['msg']);
unset($_SESSION['error']) ;

?>