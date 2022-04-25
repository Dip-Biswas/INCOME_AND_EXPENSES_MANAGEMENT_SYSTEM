<?php
    require_once "include/header.php";
?>
   <?php
        $catagory = $budget =  $budget_added = "";
         $catagoryErr = $budgetErr = "";
         $email = $_SESSION["email"];

        

            if($_SERVER["REQUEST_METHOD"] == "POST" ){
                
        require_once "include/database-connection.php";

                
               
               if( empty($_POST["catagory"]) ){
                $catagoryErr = "<P style='color:red'>* Please Add a catagory Name </p>";
              }else {
               $catagory = trim($_POST["catagory"]);
               $catagory = ucwords($catagory);
              }

              if( empty($_POST["budget"]) ){
                $budgetErr = "<P style='color:red'>* Please Add a budget </p>";
              }else {
               $budget= trim($_POST["budget"]);
              }


                if (!empty($catagory) && !empty($budget) ){
                   
                        $add_income = "INSERT INTO budget( catagory, budget, email ) VALUES ( '$catagory','$budget','$email' )" ;
                        $result = mysqli_query($conn , $budget);
                        $catagory = $budget = "";

                        $budget_added = " <div class='alert alert-warning alert-dismissible fade show'>
                        Budget added !
                         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                         </button> " ;
                        
                }

            }

   ?>

          <div class="container">
                <?php   echo $budget_added; ?>
   
                </div>
               <div class="form-input-content m-5">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                                    <h4 class="text-center">Add Budget </h4>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="">
                            

                                <div class="form-group">
                                    <label >Catagory :</label>
                                    <input type="text" class="form-control" value="<?php echo $catagory; ?>" name="catagory" >
                                    <?php echo $catagoryErr; ?>        
                                </div>

                                <div class="form-group">
                                    <label >Budget :</label>
                                    <input type="number" class="form-control " value="<?php echo $budget; ?>"  name="budget" >
                                    <?php echo $budgetErr; ?>        
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_income" >
                                </div>
  
                                  </form>
                            </div>
                        </div>
                    </div>
</div>

<?php
    require_once "include/footer.php";
?>