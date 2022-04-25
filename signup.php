
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up Page</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="resorce/css/style.css " rel="stylesheet ">

</head>

<body class="h-100 ">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader ">
        <div class="loader ">
            <svg class="circular " viewBox="25 25 50 50 ">
                <circle class="path " cx="50 " cy="50 " r="20 " fill="none " stroke-width="3 " stroke-miterlimit="10 " />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!-- SignUp PHP script -->


<?php

$nameErr = $emailErr = $dobErr = $passErr = $confirm_passErr= "";
$name = $email = $dob = $pass = $confirm_pass = "";

$signup_err ="";

if ( !empty( $_SERVER["REQUEST_METHOD"] == "POST" ) ) {
    


    require "include/database-connection.php";


if ( empty($_POST["name"] )) {
    $nameErr = " <p style='color:red'>* Name Is required </p>";
  } else{
      $name = trim($_POST["name"]);
  } 
  
  if ( empty($_POST["email"] )) {
    $emailErr = " <p style='color:red'>* Email Is required </p>";
  }else{
      $email = trim($_POST["email"]);
  }

  if ( empty($_POST["dob"] )) {
    $dobErr = " <p style='color:red'>* Date-Of-Birth Is required </p>";

  }else{
      $dob = trim($_POST["dob"]);
  } 
  if ( empty($_POST["password"] )) {
    $passErr = " <p style='color:red'>* Password Is required </p>";
  }else {
  $pass = trim($_POST["password"]); 
}
  if ( $_POST["password"] !== $_POST["confirmPassword"] ) {
    $confirm_passErr = " <p style='color:red'>* Password Do not matched </p>";
  } else {
      $confirm_pass = trim($_POST["confirmPassword"]);
  }


}

   if( !empty( $name) && !empty($email) && !empty($dob) && !empty($pass) && $confirm_pass ){
 
    $command_to_check_if_email_exist = "SELECT * FROM users WHERE email = '$email' ";
    $existing_user = mysqli_query($conn , $command_to_check_if_email_exist);
    
    $row_count = mysqli_num_rows($existing_user);
    
    if( $row_count > 0 ){
        $signup_err = "  <script> alert('Sorry! This email is already registered.') </script> " ;
    } else {
        $sql_command = "INSERT INTO users( name , dob , email , password ) VALUES( '$name' , '$dob' , '$email' , '$pass' )";
        $result = mysqli_query($conn , $sql_command );
        header("Location: login.php?registration-successfull ");
   }



};


?>


    <!-- Php script end -->

    <div class="login-form-bg h-100 ">
        <div class="container h-100 ">
            <div class="row justify-content-center h-100 ">
                <div class="col-xl-6 ">
                    <div class="form-input-content ">
                        <div class="card login-form mb-0 ">
                            <div class="card-body pt-5  shadow ">

                                    <?php echo $signup_err; ?>
                                <h4 class="text-center ">Expense Management System</h4>

                      <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group">
                                    <label >Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name">
                                    <?php echo $nameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email ?>" name="email" >
                                    <?php echo $emailErr; ?>
                                </div>

                            <div class="form-group">
                                <label >Date-of-Birth :</label>
                                <input type="date" class="form-control" value="<?php echo $dob ?>" name="dob" >
                                <?php echo $dobErr; ?>
                            </div>

                            <div class="form-group">
                                <label >Password :</label>
                                <input type="password" class="form-control" name="password" >
                                <?php echo $passErr; ?>
                            </div>

                            <div class="form-group">
                                <label >Confirm Password :</label>
                                <input type="password" class="form-control" name="confirmPassword" >
                                <?php echo $confirm_passErr; ?>  
                            </div>

                            <div class="form-group">
                            <input type="submit" class="btn login-form__btn submit w-100 " name="signup" >
                            </div>
  
</form>
                    
                                <p class="mt-5 login-form__footer ">Have account <a href="login.php " class="text-primary ">Sign In </a> now</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="resorce/plugins/common/common.min.js "></script>
    <script src="resorce/js/custom.min.js "></script>
    <script src="resorce/js/settings.js "></script>
    <script src="resorce/js/gleek.js "></script>
    <script src="resorce/js/styleSwitcher.js "></script>
</body>

</html>