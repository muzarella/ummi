<?php
session_start();
if(strlen($_SESSION['id'])=="")
    {   
    header("Location:../index.php"); 
    }

if (isset($_GET['student_id'])) {
    
    $student_id = $_GET['student_id'] ;
}else {

    header("location:manage_result.php") ;
}

//$teacher_id = intval($_SESSION['id']) ;
include('../config/DbFunctions.php');
$obj = new DbFunction(); 


$query =  $obj->show_student_Byid($student_id) ;
$result  = $query->fetch(PDO::FETCH_OBJ) ;
$class_id = $result->class_id;
/*$query3 =  $obj->show_subject_By_class_teacher($class_id,$teacher_id) ;
$sub_result  = $query3->fetch(PDO::FETCH_OBJ) ;*/
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
                        <h1 class="page-head-line">REPORT</h1>
                        <h1 class="page-subhead-line">This allows you to edit result of a student. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Result</li>
                                        <li class="active">Edit Result</li>
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
                        <h5> Edit Result </h5>
                     </div>
                     <div class="panel-body">
                <div>
            <form class="form-horizontal" method="post"  action="../modal/modal_result.php?student_id=<?php echo htmlentities($student_id);?>&class_id=<?php echo htmlentities($class_id);?>">

                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Subject </label>
                    <input type="hidden" class="student" name="" value="<?php echo htmlentities($student_id); ?>">
                    <button type="button" class="get_subject"  data-id='<?php echo htmlentities($class_id); ?>' > click to Enter scores </button>
                    <div class="col-sm-12">

                        <div id="all_subject">
                            
                        </div>
                      

                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-sm-2">
                        <button type="submit" name="edit_result" class="btn btn-success btn-labeled btn-right" id="submit_edit_result" > Submit  </button>
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
    <?php include('../dist/includes/footer.php') ;    ?>
    <script type="text/javascript">
      
        $(document).ready(function(){
            $("#submit_edit_result").hide() ;
        })
       $(document).on("click", ".get_subject",function(){
        var class_id = $(this).data('id') ;
        var student_id = $('.student').attr('value');
    //   
        get_subject(class_id, student_id ) ;

       })

  function get_subject (class_id, student_id ){
    // var datas = "class_id="+class_id+"&teacher_id="+teacher_id ;
   // var datas = class_id+"$"+teacher_id ;
// 'class_id='+class_id + '&teacher_id='+teacher_id 
            $.ajax({
                type:"GET",
                url:"getAll_result.php",
                data:{
                   class_id:class_id,
                   student_id:student_id 
                },
                success: function(data){
                    $('#all_subject').html(data) ;
                }


            })
$('.get_subject').hide();
$('#submit_edit_result').show();
        }

    </script>


</body>
</html>

<?php 
unset($_SESSION['msg']);
unset($_SESSION['error']) ;

?>
