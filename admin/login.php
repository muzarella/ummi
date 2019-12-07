<?php 

?>

 <?php include('./includes/footer.php') ;    ?>
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
 <?php include('./includes/footer.php') ;    ?>
</body>
</html>






