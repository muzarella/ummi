<?php 






?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> UMMI </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- BOOTSTRAP STYLES-->
    <link href="../dist/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../dist/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- css style  STYLES-->
  <link rel="stylesheet" href="../dist/css/style.css">

    <!-- FONTAWESOME STYLES
  <link rel="stylesheet" href="../dist/bootstrap/bootstrap/3.3.6/css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="../dist/fontawesome-free-5.0.8/fontawesome-free-5.0.8/web-fonts-with-css/css/fontawesome.css">

-->
  <script src="../dist/jquery-3.1.1.js"></script>
  <script src="../dist/bootstrap/bootstrap/3.3.6/js/bootstrap.js"></script>

</head>

<body>
<h2 class="ummi"> UMMI INTERNATIONAL SCHOOL </h2>
<div class="container2">
  <img src="img/ummi_logo.jpg"   />
  <form method="POST" action="../modal/modal_login.php">
    <div class="form-group">
      <label for="email">Username  <span class="glyphicon glyphicon-envelope"></span> </label>
      <input type="text" class="form-control" name="username" placeholder="Enter username" required />

    </div>
    <div class="form-group">
      <label for="pwd">Password <span class="glyphicon glyphicon-lock"></span> </label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required />
    </div>
 <!--    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div> -->
    <button type="submit" name="submit" class="btn-login">Submit</button>
  </form>
</div>

</body>

<!-- Mirrored from www.w3schools.com/bootstrap/tryit.asp?filename=trybs_form_basic&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Jan 2017 16:50:31 GMT -->
</html>





