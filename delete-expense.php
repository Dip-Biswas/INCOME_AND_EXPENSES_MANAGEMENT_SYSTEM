
<?php 

require_once "include/database-connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM expenses WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-expense.php?delete-success-where-id=" .$id );


?>

