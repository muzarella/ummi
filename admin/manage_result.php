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

//$teacher_id = $_SESSION['id'] ;

include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// recieve the object returned from the function 

// recieve the object returned from the function 
$query =  $obj->show_class() ;
$results  = $query->fetchAll(PDO::FETCH_OBJ) ;


/*
foreach($results as $row){
 $students[] = array('id'=>$row['student_id'], 'name'=>$row['surname']." ".$row['first_name'], 'gender'=>$row['gender'], ) ;
}
<?php foreach($students as $student ): ?>
<?php echo $student['name'] ;
echo  "<br />". $student['gender'] ;
echo " my data lollll";
 ?>
<?php endforeach; ?>
*/


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
                        <h1 class="page-head-line">RESULT</h1>
                        <h1 class="page-subhead-line">This allows you to manage result of students. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li>Student Result </li>
                                        <li class="active"> Show Student </li>
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
                        <h5> Manage Student Result(<span> <?php echo  $query->rowCount(); ?> ) </span> </h5>
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


  <!-- select the class so as to shhow subject  -->
             <div class="form-group">
                    <label class="control-labbel col-sm-2"> Select class to view student </label>
                    <div class="col-sm-10">
                       <select name="class_id" class="form-control" id="class_name"  required="required" onchange="get_subject(this.value); " >
                    <option value=""> Select class</option>
                <?php

                if($query->rowCount() > 0 ){
                    foreach ($results as $result) {
                 ?>
                    <option value="<?php echo htmlentities($result->class_id); ?>" > <?php echo htmlentities($result->class); ?>  </option>
                 <?php 
                    }
                     }
                 ?>
                        </select>
                    </div>
                </div>

            <!-- end -->

            <!-- beggining of div for table  -->
         <div id="all_student">
  
         </div>
        <!-- end of div for  table  -->


  <!-- begginging of modal  class to view studdent -->
<br />
<div class="col-md-12">

  <!-- Modal -->
  <div id="view_student" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Student information </h4>
        </div>
        <div class="modal-body">
        
            <div class="col-md-12">
              <center>
              <span class="image"> <img  id="image" class="img-responsive" src="uploads/img1.jpg" alt="Student" width="35" height="55" /> </span>
             </center>
            </div>
              <div class="row">
            <div class="col-md-6">
              <p class=''><b> Name: </b> <span class="name"> Fetching...</span> </p>
              <p class=''><b> gender: </b> <span class="gender"> Fetching...</span> </p>
              <p class=''><b> date of birth: </b> <span class="dob"> Fetching...</span> </p>
            </div>
            <div class="col-md-6">
              <p class=''><b> class: </b> <span class="class"> Fetching...</span> </p>
              <p class=''><b> Parent name: </b> <span class="parent_name"> Fetching...</span> </p>
              <p class=''><b> parent phone number: </b> <span class="parent_phone"> Fetching...</span> </p>
            </div>
            <div class="col-md-12">
              <p class=''><b> parent address: </b> <span class="parent_address"> Fetching...</span> </p>
            </div>
 


          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- ending of modal class  -->



<!-- begginging of modal  class to add result for  student -->
<br />
<div class="col-md-12">

  <!-- Modal -->
  <div id="add_result" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Edit Result  </h4>
        </div>
        <div class="modal-body">
           <!-- beggining of div to show adding result form  -->
         <div id="edit_resultform">

         </div>
        <!-- end of div to show adding result form  --> 
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- ending of modal class for result   -->
          
                     </div>
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
 <script type="text/javascript">
        
      /*    $(document).on("change", ".get_subject",function(){
        var val = $(this).data('id') ;
    //    window.alert(val);
        get_subject(val) ;

       })*/

  function get_subject (val){
            $.ajax({
                type:"POST",
                url:"getedit_result_student.php",
                data: 'class_id='+ val,
                success: function(data){
                    $('#all_student').html(data) ;
                }


            })
// $('.get_subject').hide();
        }

    </script>


 <script type="text/javascript">
    // view  button from  loaded table 


$(document).on("click", ".show_modal", function(){
var view_id = $(this).data('id') ;
 //window.alert(view_id);
view_student(view_id) ;

} )



function  view_student(stu_id){
  var student_id = stu_id ;
 // window.alert(student_id);
$.ajax({
type:"POST",
url:"view_student.php",
data:'id='+ student_id ,
success: function (e){
  try{
    e = JSON.parse(e)
    if (e.response == 200){
setTimeout(function(){
$('#view_student').find('.name').html(e.data[0].name)
$('#view_student').find('.class').html(e.data[0].class)
$('#view_student').find('.gender').html(e.data[0].gender)
$('#view_student').find('.dob').html(e.data[0].dob)
$('#view_student').find('.parent_name').html(e.data[0].parent_name)
$('#view_student').find('.parent_phone').html(e.data[0].parent_phone)

$('#view_student').find('.parent_address').html(e.data[0].parent_address) 
var id = e.data[0].student_id 
var url = 'edit_student.php?student_id='+ id +' '
$("#view_student").find("#edit").attr('href', url)
$('#view_student').find('.image').html('<img class="img-responsive" src ="' + e.data[0].image + '" alt="student image" width="70" height="75" />')
 /*var _holder = $("#edit");
 $("<img />", {
                    "src": e.target.result,
                        "class": "col-sm-4 img-responsive",
                        "id":"img_size",
                       "width"="80",
                        "height"="85"
                    }).appendTo(_holder);*/


 }, 2000 )
    }else if(e.response == 409 ){
      alert(e.message)
    }
  }catch (e){
    alert(e) ;
  }
},
error:  function (e){
  alert ("sorry no request to this page " + e );
}

})

}



    
  </script>

<script type="text/javascript">

      


$(document).on("click", ".show_modal_result", function(){
var view_id = $(this).data('id') ;
 // window.alert(view_id);
getAdd_result(view_id) ;

} )

  function getAdd_result (val){
   //  window.alert("val ="+val);
            $.ajax({
                type:"GET",
                url:"edit_result.php",
                data: 'student_id='+ val,
                success: function(data){
                    $('#edit_resultform').html(data) ;
                }


            })
// $('.get_subject').hide();
        }

    </script>

</body>
</html>

<?php 
unset($_SESSION['msg']);
unset($_SESSION['error']) ;

?>