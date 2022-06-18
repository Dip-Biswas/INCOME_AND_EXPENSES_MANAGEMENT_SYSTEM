<?php 
    require_once "include/header.php";
?>

<!-- script to show modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

<?php
       
       $firstDayErr = $lastDayErr = "";
       $firstDay= $lastDay = "";
        $item = $date = $price =  "";
        $i= 1;
        require_once "include/database-connection.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            // echo "clicked";

            if(empty($_REQUEST["first-day"])){
                $firstDayErr =" <p style='color:red'>* Please Select a Date </p>";
            } else {
                $firstDay = $_REQUEST["first-day"];
            } 
               
            if(  $_POST["last-day"] == "0" ){
               $lastDayErr = " <p style='color:red'>* Please Select a Operation </p>";

            } elseif ($_POST["last-day"] == "1" ){
                $temp_lastDay = strtotime( $firstDay."-1 week");
                $lastDay= date( "Y-m-d", $temp_lastDay);
                $sql_command = "SELECT date , item , price FROM expenses WHERE date   BETWEEN '$lastDay' AND '$firstDay' AND email = '$_SESSION[email]' ORDER BY date " ;
               
                $result = mysqli_query($conn , $sql_command);
                $rows = mysqli_num_rows($result);
                
                ?>
                
                <div class='container '> 
                    <h4 class='text-center pt-5 hide'>Weekwise Expense Report </h4>
                        <table class='table table-bordered table-hover border-primary mt-5 bg-light shadow hide'>
                            <thead> 
                                <tr>
                                    <th> id </th>
                                    <th> Date </th>
                                    <th> Item </th>
                                    <th> Price in $</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php 
                                        if( $rows > 0){
                                        while($rows = mysqli_fetch_assoc($result)){
                                            $date = $rows["date"];
                                            $date = date("jS F" , strtotime($date) );
                                            $item =  $rows["item"];
                                            $price =  $rows["price"];
                                            echo "<tr> <th> $i   </th> <th>  $date  </th> <th>   $item</th> <th>   $price</th> </tr> ";
                                            $i++;
                                            } 
                                            echo "
                                                    </tbody> 
                                                    </table> 
                                              ";

                                            //   hiding form when result found
                                            echo "<style> #form{ display:none } </style>";
                                            echo "<div class='text-center pt-4 pb-5'> <a href='weekwise-report.php' class='btn btn-primary btn-lg'> Check More </a>
                                            <a href='pdf_gen.php?firstDay={$firstDay}&lastDay={$lastDay}' class='btn btn-danger btn-lg text-white'> Save as PDF </a> </div>";
                    
                                    ?> 
                </div> 
                    <?php
                        } else {
                            $firstDay = date( 'jS F' , strtotime("$firstDay") );
                            $lastDay = date( 'jS F' , strtotime("$lastDay") );
                                echo "<script>
                                        $(document).ready(function() {
                                            $('#addMsg').text( 'Sorry! No result Found between $lastDay and $firstDay. '  );
                                            $('#changeHrefForAdding').attr('href', 'add-expense.php');
                                            $('#changeHrefForAdding').text('Add Expenses For the Week');
                                            $('#showModal').modal('show');
                                            $('.hide').hide();
                                        });
                                  </script>";
                                }

            }  else {
                $temp_lastDay = strtotime( $firstDay."+1 week");
                $lastDay= date( "Y-m-d", $temp_lastDay);
                    
                
                 $sql_command = "SELECT date , item , price FROM expenses WHERE date   BETWEEN '$firstDay' AND '$lastDay' AND email = '$_SESSION[email]' ORDER BY date " ;
                
                 $result = mysqli_query($conn , $sql_command);
                 $rows = mysqli_num_rows($result);
                

                 ?>

<div class='container'> 
    <h4 class='text-center pt-5 hide'> WeekWise Expense Report </h4>
        <table class='table table-bordered table-hover border-primary bg-white shadow mt-5 hide'>
            <thead> 
                <tr>
                    <th> id </th>
                    <th> Date </th>
                    <th> Item </th>
                    <th> Price in $</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                 if( $rows > 0){
                   while( $rows = mysqli_fetch_assoc($result) ){
                      $date = $rows["date"];
                      $date = date("jS F" , strtotime($date) );
                      $item = $rows["item"];
                      $price = $rows["price"];

                         echo "<tr> <th> $i   </th> <th>  $date  </th> <th>   $item</th> <th>   $price</th> </tr> ";
                         $i++;
                    } 
                echo "</tbody> </table> ";
                echo "<style> #form{ display:none } </style>";
                echo "<div class='text-center pt-4 pb-5'> <a href='weekwise-report.php' class='btn btn-primary btn-lg'> Check More </a>
                <a href='pdf_gen.php?firstDay={$firstDay}&lastDay={$lastDay}' class='btn btn-danger btn-lg text-white'> Save as PDF </a> </div>";

                   
                } else {
                    $firstDay = date( 'jS F' , strtotime("$firstDay") );
                    $lastDay = date( 'jS F' , strtotime("$lastDay") );
                    echo "<script>
                            $(document).ready(function() {
                                $('#addMsg').text( 'Sorry! No result Found between $firstDay and $lastDay. '  );
                                $('#changeHrefForAdding').attr('href', 'add-expense.php');
                                $('#changeHrefForAdding').text('Add Expenses For the Week');
                                $('#showModal').modal('show');
                                $('.hide').hide();
                             });
                         </script>";
                } 
            ?>
</div> 
        <?php 
            }
             
}   

    ?>

<div class="container ">
    <div id="form" class="pt-5 form-input-content">
        <div class="card login-form mb-5">
            <div class="card-body pt-5 bg-white shadow">
                  <h4 class="text-center">Weekwise Expense Report </h4>
                    <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                        <div class="form-group">
                            <label >Select First Day of the Week:</label>
                            <input type="date" class="form-control" value="<?php echo $firstDay; ?>" name="first-day" >  
                            <?php echo  $firstDayErr; ?>                   
                        </div>

                        <div class="form-group">
                            <select class="form-control" name = "last-day">
                                <option value="0"> Report Before/After Selected Date </option>
                                <option value="1"> Weekly Report Before Selected Date</option>
                                <option value="2"> Weekly Report After Selected Date</option>     
                            </select> 
                                <?php echo $lastDayErr; ?>               

                        </div>

                            <div class="form-group">
                                <input type="submit" value="Show Report" class="btn login-form__btn submit w-10 " name="submit_expense" >
                            </div>
  
                    </form>
                </div>
        </div>
    </div>
</div>


<?php 
    require_once "include/footer.php";
?>