<?php
    require_once "include/header.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>





<?php 
require "include/database-connection.php";


        $i = 1;
        $email = $_SESSION["email"];
        $date = $item = $price =  $id =  "";
      
        $sql_command = "SELECT * FROM expenses WHERE email = '$email'  ORDER BY date ";
        $result = mysqli_query($conn ,$sql_command ) ;
            $row = mysqli_num_rows($result);
            
        
?>




<div class="container bg-light shadow mt-5">

<h4 class='text-center pt-5 hide'>All Expenses  </h4>

<table class=" table table-bordered table-hover border-primary">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Register Date</th>
      <th scope="col">Item</th>
      <th scope="col">Price in $</th>
    </tr>
  </thead>
  <tbody>
<?php

  if( $row > 0){
    while( $row = mysqli_fetch_assoc($result)){  

           $id = $row["id"];
            $date = $row["date"];
            $datef = date("jS F" , strtotime($date) );

            $item = $row["item"];
            $price = $row["price"];

            $edit_icon = "<span ><i class='fa fa-edit'></i></span> ";
            $edit = " <a href='edit-expense.php?id={$id}&item={$item}&price={$price}&date={$date}' class='btn-sm btn-primary float-right'> $edit_icon </a> ";
            $bin = " <a href='delete-expense.php?id={$id}' id='bin' class='btn-sm btn-primary float-right ml-2'> <span ><i class='fa fa-trash '></i></span> </a> ";
        echo " <tr> <th> {$i}. </th> <th> {$datef} </th> <th> {$item} </th> <th> {$price} {$bin} {$edit}  </th>
                  "; 
        $i++;
    }



}else {
  echo "<script>
  $(document).ready(function() {
      $('#addMsg').text( 'You dont have any expenses!');
      $('#changeHrefForAdding').attr('href','add-expense.php');
      $('#changeHrefToShowReport').text('Reminde me latter');
      $('#changeHrefForAdding').text('Add Expenses');
      $('#showModal').modal('show');
    });
    </script>";
}

?>
  
  </tbody>
</table>

</div>



<?php
    require_once "include/footer.php";
?>