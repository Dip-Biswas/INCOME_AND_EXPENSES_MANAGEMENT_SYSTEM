<?php

    session_start();

    if( !$_SESSION["email"] ){
        header("Location: login.php");
    }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

<?php 
      $dobErr = $new_passErr = $confirm_passErr = "";
     $dob = $new_pass = $confirm_pass = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_REQUEST["dob"])){
            $dobErr = " <p style='color:red'>* Date of birth Is required </p>";
        }else{
            $dob = trim($_REQUEST["dob"]);
        }
        
        if(empty($_REQUEST["new_pass"])){
            $new_passErr = " <p style='color:red'>* New Password Is required </p>";
        }else{
            $new_pass = trim($_REQUEST["new_pass"]);
        }

        if(empty($_REQUEST["confirm_pass"])){
            $confirm_passErr = " <p style='color:red'>* Please Confirm new Password! </p>";
        }else{
            $confirm_pass = trim($_REQUEST["confirm_pass"]);
        }

        if(!empty($dob) && !empty($new_pass) && !empty($confirm_pass) ){

            require_once "include/database-connection.php";

            $check_dob = "SELECT dob FROM users WHERE email = '$_SESSION[email]' && dob = '$dob' ";
            $result = mysqli_query($conn , $check_dob);
            if( mysqli_num_rows($result) > 0 ){
               
                if( $new_pass === $confirm_pass ){
                  
                    $change_pass_query = "UPDATE users SET password = '$new_pass' WHERE email = '$_SESSION[email]' ";
                    if (mysqli_query($conn , $change_pass_query) ){
                        session_unset();
                        session_destroy();
                        echo "<script>
                        $(document).ready(function() {
                            $('#addMsg').text( 'Password Updated successfully! Log in With New Password');
                            $('#changeHrefForAdding').attr('href','profile.php');
                            $('#changeHrefForAdding').text('OK, Understood');
                            $('#changeHrefToShowReport').hide();
                            $('#modal_cross_btn').text('');
                            $('#showModal').modal('show');
                        });
                        </script>";
                    }
                    
                }else{
                    $confirm_passErr = "<p style='color:red'>* Confirm did not matched new Password! </p>";
                }

            }else{
               $dobErr = " <p style='color:red'>*Sorry! DoB is Wrong </p> ";
            }
        }
    }
?>


<div style="margin-top:100px"> 
<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center">Change Password</h4>
                                    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                        <div class="form-group">
                                            <label >DOB : </label>
                                            <input type="date" name="dob" class="form-control">
                                            <?php echo $dobErr; ?>
                                        </div>
                                        <div class="form-group">
                                            <label >New Password : </label>
                                            <input type="password" name="new_pass" class="form-control">
                                            <?php echo $new_passErr; ?>

                                        </div>
                                        <div class="form-group">
                                            <label >Confirm Password : </label>
                                            <input type="password" name="confirm_pass" class="form-control">
                                            <?php echo $confirm_passErr; ?>

                                        </div>
                
                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group">
                                        <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes" >        
                                            </div>
                                            <div class="input-group">
                                                <a href="login.php" class="btn btn-primary w-20">Close</a>
                                            </div>
                                        </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

