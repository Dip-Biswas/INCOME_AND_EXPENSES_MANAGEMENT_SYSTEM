 <?php 
require_once "include/header.php"; 
?> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

<!-- update profile Php script -->

<?php 

        $nameErr = $emailErr = $dobErr = "";
       $name = $email = $dob = "";

      if(  $_SERVER["REQUEST_METHOD"] == "POST" ){
        require "include/database-connection.php";


        if( empty($_POST["fname"]) ){
          $nameErr = "<p style='color:red'>* Name Is required </p>";
        } else {
          $name = trim($_POST["fname"]);
        }

        // if( empty($_POST["email"]) ){
        //     $emailErr = "<p style='color:red'>* Email Is required </p>";
        //   } else {
        //     $email = trim($_POST["email"]);
        //   }

          if( empty($_POST["dob"]) ){
            $dobErr = "<p style='color:red'>* Date-of-Birth Is required </p>";
          } else {
            $dob = trim($_POST["dob"]);
          }

          if( !empty($name) && !empty($email) && !empty($dob)  ){
              
        //    database connection 

        $session_email = $_SESSION['email'];
      
        $sql = "SELECT email FROM users WHERE email = '$email' ";
        $existing_email = mysqli_query($conn , $sql);
        $rows= mysqli_num_rows($existing_email);

        if( $rows > 0 ){

            echo "<script>
            $(document).ready(function() {
                $('#addMsg').text( 'Email Already Assign to other User!');
                $('#changeHrefForAdding').hide();
                $('#changeHrefToShowReport').text('OK');
               
                $('#showModal').modal('show');
            });
            </script>";
            
        }else {
            $sql_command = "UPDATE users SET name = '$name', email = '$email' , dob = '$dob' WHERE email = '$session_email' ";
             $result = mysqli_query($conn , $sql_command);
            
            $update_email_in_expenses_table = "UPDATE expenses SET email = '$email'  WHERE email = '$session_email' ";
                $result1 = mysqli_query($conn , $update_email_in_expenses_table);
                    echo "update success";
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $name;
                    $_SESSION["dob"] = $dob;
                    echo "<script>
                    $(document).ready(function() {
                        $('#addMsg').text( 'Profile updated successfully!');
                        $('#changeHrefForAdding').attr('href','profile.php');
                        $('#changeHrefForAdding').text('Check Profile');
                        $('#changeHrefToShowReport').hide();
                        $('#modal_cross_btn').text('');
                        $('#showModal').modal('show');
                    });
                    </script>";
                }


        
    }
} 
?>



<!-- end -->
<div style="margin-top:100px"> 
<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center">Update Your Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Full Name :</label>
                                    <input type="text" class="form-control" value="<?php echo trim($name); ?>" name="fname" >
                                    <?php echo $nameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?> "  name="email" >  
                                    <?php echo $emailErr; ?>     
                                </div>

                                <div class="form-group">
                                    <label >Date-of-Birth :</label>
                                    <input type="date" class="form-control" value="<?php echo $dob; ?>"  name="dob" >  
                                    <?php echo $dobErr; ?>     
                                </div>

                               

                                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group">
                                   <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes" >        
                                    </div>
                                    <div class="input-group">
                                         <a href="profile.php" class="btn btn-primary w-20">Close</a>
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
<?php 
require_once "include/footer.php"; 
?>