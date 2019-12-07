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
include('../config/DbFunctions.php');
$obj = new DbFunction(); 
// use for the select case 
$query2 = $obj->show_class() ;
$class_results = $query2->fetchAll(PDO::FETCH_OBJ);
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
                        <h1 class="page-head-line">STUDENT</h1>
                        <h1 class="page-subhead-line">This allows you to add student profile to   your number of class. </h1>
                         <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Student </li>
                                        <li class="active">Create Student</li>
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
                        <h5> Create Student </h5>
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
            <form class="form-horizontal" method="post"  action="../modal/modal_student.php" enctype="multipart/form-data" >
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Student  SurName</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter student surname here... " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Student First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter student first name " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Student Other Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="other_name" class="form-control" id="other_name" placeholder="Enter student other names " required="required" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-labbel col-sm-2"> Student Gender</label>
                    <div class="col-sm-10">
                       <input type="radio" name="gender" value="Male" required="required" checked=""> &nbsp;Male &nbsp; <input type="radio" name="gender" value="Female" required="required"> &nbsp;Female &nbsp; <input type="radio" name="gender" value="Other" required="required"> &nbsp;Other
                    </div>
                </div>
                  <div class="form-group">
                    <label class="control-labbel col-sm-2"> Date of Birth</label>
                    <div class="col-sm-2">
                        <input type="date" name="dob" class="form-control" id="other_name" placeholder="Enter student other names " required="required" min="1980-12-31" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-labbel col-sm-2"> Guardian name </label>
                    <div class="col-sm-10">
                        <input type="text" name="guardian" class="form-control" id="guardian_name" placeholder="Enter Guardian name " required="required" />
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-labbel col-sm-2"> Guardian phone_number </label>
                    <div class="col-sm-10">
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone number " required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-labbel col-sm-2"> Student class</label>
                    <div class="col-sm-10">
                       <select name="class_id" class="form-control" id="class_name" required="required">
                    <option value=""></option>
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
                    <label class="control-labbel col-sm-2"> Guardian Address </label>
                    <div class="col-sm-10">
                        <textarea name="address"  required="required"  class="form-control">Enter Address here..
                        </textarea> 
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="control-labbel col-sm-2"> Select image </label>
                    <div class="col-sm-4">
                        <input type="file" name="image_upload" class="form-control" id="image_upload" required="required" onchange="readURL(this);" />
                    </div>
                     <div class="col-sm-4">
                        <img  id="preview" src="#" alt="preview image" class="img-responsive"  />
                    </div>
                </div> -->
                 <div class="form-group">
                    <label class="control-labbel col-sm-2"> Select image </label>
                    <div class="col-sm-4">
                        <input type="file" name="image_upload" class="form-control" id="fileUpload" required="required" />
                    </div>
                     <div class="col-sm-4">
                       <div id="image-holder"></div>
                    </div>
                </div>
                <br /><br />
                <div class="form-group has-success" style="float: right;" >
                    <div class="col-sm-2">
                        <button type="submit" name="submit_create_student" class="btn btn-info btn-labeled" id="submit_create_class" > Submit <span class="btn-label btn-label-right"> <i class="fa fa-check" style="font-size:20px"></i></span> </button>
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
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <?php include('../dist/includes/footer.php') ;    ?>
    <style type="text/css">
    img .thumb-image{
            width: 160px;
            height: 100px;
            border-radius: 4px;
    }
    </style>

    <script type="text/javascript">
        function readURL(input){
            if(input.files && input.files[0]){

                var reader = new FileReader();
                reader.onload = function (e){
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }



        }

        $("#fileUpload").on('change', function () {

    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "col-sm-8 img-responsive",
                        "id":"img_size"
                }).appendTo(image_holder);
            //class : thumb-image
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    } else {
        alert("Pls select only images");
    }
});


    </script>


</body>
</html>
<?php
unset($_SESSION['msg']);
unset($_SESSION['error']) ;
?>