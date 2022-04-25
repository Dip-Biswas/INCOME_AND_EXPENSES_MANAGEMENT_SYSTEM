<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Income and Expense Management - Log in form</title>
    <link href="resorce/css/style.css" rel="stylesheet">

</head>

<body class="h-100">

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>


<!-- Login Php script -->


<?php 

$emailErr = $passErr = $loginErr =  "";
$email = $pass = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST" ){
        
        // database connnection 

        require "include/database-connection.php";

        

        if ( empty($_POST["email"] )) {
            $emailErr = " <p style='color:red'>* Email Is required </p>";
          }else{
              $email = trim($_POST["email"]);
          }
        
        if ( empty($_POST["password"] )) {
            $passErr = " <p style='color:red'>* Password Is required </p>";
         }else {
             $pass = trim($_POST["password"]); 
        }
       

if (!empty($email) && !empty($pass) ){

    $sql_command = " SELECT * FROM users WHERE email='$email' AND password='$pass' ";
    $result =mysqli_query($conn , $sql_command);

    $row = mysqli_num_rows($result);

    if($row > 0){
        while( $row = mysqli_fetch_assoc($result) ){
            session_start();
            $_SESSION["email"] = $row["email"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["dob"] = $row["dob"];
             header("Location: index.php?login-success");           
        }
    }else {
      $loginErr = " <script> alert('Sorry! Invalid Email/Password!!') </script>";
    }

}
        
       
}

?>


<!-- End php script -->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <?php echo $loginErr; ?>
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                              
                                    <h4 class="text-center">Income and Expense Management System</h4>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" >  
                                    <?php echo  $emailErr; ?>       
                                </div>

                                <div class="form-group">
                                    <label >Password :</label>
                                    <input type="password" class="form-control" name="password" >
                                    <?php echo  $passErr; ?>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn login-form__btn submit w-100 " name="signin" >
                                </div>
  
                                  </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="signup.php" class="text-primary">Sign Up</a> now</p>
                                <p class="mt-5 login-form__footer">Cant access account? <a href="forget-password.php" class="text-primary">Reset Password</a> now</p>
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
    <script src="resorce/plugins/common/common.min.js"></script>
    <script src="resorce/js/custom.min.js"></script>
    <script src="resorce/js/settings.js"></script>
    <script src="resorce/js/gleek.js"></script>
    <script src="resorce/js/styleSwitcher.js"></script>
</body>

</html>