<?php
    require_once "include/header.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

   <?php

        $date = $item = $price= "";
        $dateErr = $itemErr = $priceErr = "";
         $email = $_SESSION["email"];

        
         $id= $_GET["id"];
         $date = $_GET["date"];
         $item = $_GET["item"];
         $price= $_GET["price"];

            if($_SERVER["REQUEST_METHOD"] == "POST" ){
                
               require_once "include/database-connection.php";

                if( empty($_POST["expense_date"]) ){
                    $dateErr = "<P style='color:red'>* Please Add a Expense Date </p>";
                    $date = "";
               }else {
                   $date = trim($_POST["expense_date"]);
               }

               if( empty($_POST["item"]) ){
                $itemErr = "<P style='color:red'>* Please Add a Item Name </p>";
                $item ="";
              }else {
               $item = trim($_POST["item"]);
               $item = ucwords($item);
              }

              if( empty($_POST["expense_price"]) ){
                $priceErr = "<P style='color:red'>* Please Add a Item Price </p>";
                $price = "";
              }else {
               $price = trim($_POST["expense_price"]);
              }

              if ( !empty($date) && !empty($item) && !empty($price) ){
                   
               $sql = "UPDATE expenses SET date = '$date' , item='$item' , price='$price' WHERE id='$id' ";
               $result = mysqli_query($conn , $sql);

              

                  echo "<script>
                  $(document).ready(function() {
                      $('#addMsg').text( 'Expense Details Updated!');
                      $('#changeHrefToShowReport').hide();
                      $('#modalHead').hide();

                      $('#changeHrefForAdding').attr('href','manage-expense.php');
                      $('#changeHrefForAdding').text('Ok, Understood');
                      $('#showModal').modal('show');
                    });
                    </script>";
             
       }
               

   }

   ?>

          <div class="container m-5">
              
          <div class="container row">
          <div class="col align-self-center">
               <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                    <h4 class="text-center">Edit Expense </h4>

                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Date :</label>
                                    <input type="date" class="form-control" value="<?php echo $date; ?>"  name="expense_date" >
                                    <?php echo $dateErr; ?>                     
                                </div>

                                <div class="form-group">
                                    <label >Item :</label>
                                    <input type="text" class="form-control" value="<?php echo $item; ?>" name="item" >
                                    <?php echo $itemErr; ?>        
                                </div>

                                <div class="form-group">
                                    <label >Price :</label>
                                    <input type="number" class="form-control " value="<?php echo $price; ?>"  name="expense_price" >
                                    <?php echo $priceErr; ?>        
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Add" class="btn login-form__btn submit w-10 " name="submit_expense" >
                                </div>
  
                                  </form>
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