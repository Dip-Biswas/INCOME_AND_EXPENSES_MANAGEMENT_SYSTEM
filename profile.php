

<?php 
require_once "include/header.php"; 
?>

<div class="container">

  <div class="row">
      <div class="col-4">

      </div>

      <div class="col-4 col-12-md">
      <div class="card shadow">
    <img src="resorce/avatar.png" class="img-thumbnail"  height="4px">
    <div class="card-body">

      <h1 class=" text-center"> <?php  echo ucwords($_SESSION["name"]); ?> </h1>
      <p class="card-text mt-5">Full Name : <?php echo ucwords($_SESSION["name"]); ?></p>
      <p class="card-text">Email: <?php echo $_SESSION["email"]; ?></p>
      <p class="card-text"> Date of Birth : <?php echo date( 'jS F, Y' , strtotime($_SESSION["dob"]) ); ?> </p>

      <div class="text-center"> 
      <a class='btn  btn-primary text-white' href="update-profile.php" >Update Profile </a>
      <a class='btn btn-primary text-white' href="change-pass.php" >Change Password </a>
      </div>

    </div>
  </div>
    </div>

  </div>

</div>

<script>

</script>

<?php 
    require_once "include/footer.php";
?>