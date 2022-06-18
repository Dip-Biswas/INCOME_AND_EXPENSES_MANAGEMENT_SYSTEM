<?php
    require_once "include/header.php";
?>

<?php 
date_default_timezone_set("Asia/kolkata");
    $todayExp=$todayincome = $totalincome=$yesterdayExp = $weeklyExp = $monthlyExp = $yearlyExp = $totalExp = $totalbudget =$monthlyincome=$febincome=0;
    $fm=0;
    $sm=0;
    $yesterday_item=$monthly_item="";
    $i=1;
    
    $jan_date =date("Y-m-01");
    $feb_date=date("Y-2-01");
    $lastday=date("Y-m-t");
    $current_date = date("Y-m-d " , strtotime("now"));
    $yesterday_date = date("Y-m-d " , strtotime("yesterday"));
    $weekly_date = date("Y-m-d " , strtotime("-1 week"));
    $monthly_date = date("Y-m-d " , strtotime("-1 month"));
    $yearly_date =  date("Y-m-d " , strtotime("-1 year"));
    $temp_lastDay = strtotime( $current_date."-1 week");
    $lastDay= date( "Y-m-d", $temp_lastDay);
    // database connection
    require_once "include/database-connection.php";

// Today's expense------------------------------------------------------------------------------------------------
    $sql_command_todayExp = "SELECT price , date FROM expenses Where date= '$current_date' AND email = '$_SESSION[email]' ";
    $result = mysqli_query($conn ,$sql_command_todayExp);
    $rows =  mysqli_num_rows($result);
    
    if($rows > 0){
        while ($rows = mysqli_fetch_assoc($result) ){
            $todayExp += $rows["price"];
        }
    }
    $sql_command_todayincome = "SELECT price , date FROM income Where date= '$current_date' AND email = '$_SESSION[email]' ";
    $result = mysqli_query($conn ,$sql_command_todayincome);
    $rows =  mysqli_num_rows($result);
    
    if($rows > 0){
        while ($rows = mysqli_fetch_assoc($result) ){
            $todayincome += $rows["price"];
        }
    }
    $sql_command_totalincome = "SELECT price , date FROM income Where email = '$_SESSION[email]' ORDER BY date ";
    $result_t = mysqli_query($conn , $sql_command_totalincome) ;
    $rows_t =  mysqli_num_rows($result_t);
    if($rows_t > 0){
        while ($rows_t = mysqli_fetch_assoc($result_t) ){
            $totalincome += $rows_t["price"];
        }
    }

// Yesterday's Expense--------------------------------------------------------------------------------------------------------



// weekly expense------------------------------------------------------------------------------------------------------------
$sql_command_weeklyExp = "SELECT price , date FROM expenses Where date BETWEEN '$weekly_date' AND '$current_date' AND email = '$_SESSION[email]'  ORDER BY date ";
$result_w = mysqli_query($conn , $sql_command_weeklyExp) ;
$rows_w =  mysqli_num_rows($result_w);
if($rows_w > 0){
    while ($rows_w = mysqli_fetch_assoc($result_w) ){
        $weeklyExp += $rows_w["price"];
    }
}

// monthly expense -----------------------------------------------------------------------------------------------------------
$sql_command_monthlyExp = "SELECT price , date FROM expenses Where date BETWEEN '$monthly_date' AND '$current_date' AND email = '$_SESSION[email]' ORDER BY date ";
$result_m = mysqli_query($conn , $sql_command_monthlyExp) ;
$rows_m =  mysqli_num_rows($result_m);
if($rows_m > 0){
    while ($rows_m = mysqli_fetch_assoc($result_m) ){
        $monthlyExp += $rows_m["price"];
    }
}


//per month income


// yearly expense----------------------------------------------------------------------------------------------------------
$sql_command_yearlyExp = "SELECT price , date  FROM expenses Where date BETWEEN '$yearly_date' AND '$current_date' AND  email = '$_SESSION[email]' ";
$result_year = mysqli_query($conn , $sql_command_yearlyExp) ;
$rows_year =  mysqli_num_rows($result_year);
if($rows_year > 0){
    while($rows_year = mysqli_fetch_assoc($result_year)){
        $yearlyExp += $rows_year['price'];  
    }
}

 

// total expense------------------------------------------------------------------------------------------------------
$sql_command_totalExp = "SELECT price , date FROM expenses Where email = '$_SESSION[email]' ORDER BY date ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$rows_t =  mysqli_num_rows($result_t);
if($rows_t > 0){
    while ($rows_t = mysqli_fetch_assoc($result_t) ){
        $totalExp += $rows_t["price"];
    }
}
$sql_command_totalbudget = "SELECT price , date FROM budget Where email = '$_SESSION[email]' ORDER BY date ";
$result_t = mysqli_query($conn , $sql_command_totalbudget) ;
$rows_t =  mysqli_num_rows($result_t);
if($rows_t > 0){
    while ($rows_t = mysqli_fetch_assoc($result_t) ){
        $totalbudget += $rows_t["price"];
    }
}

?>






<div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Income</div>
            <div class="number"><?php echo $totalincome; ?></div>
            <div class="indicator">
              <i class='bx bx-box'></i>
              <span class="text">This month</span>
            </div>
          </div>
         
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Today's Expenses</div>
            <div class="number"><?php echo $todayExp; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">till now</span>
            </div>
          </div>
         
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Expenses'</div>
            <div class="number"><?php echo $totalExp; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">till now</span>
            </div>
          </div>
          
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Remaining Budgets</div>
            <div class="number"><?php if ($totalbudget> $totalExp){echo $totalbudget-$totalExp;}
            else{
              echo "0";
            } ?></div>
            <div class="indicator">
              <i class='bx bx-coin-stack'></i>
              <span class="text">Total Budget : <?php echo $totalbudget?></span>
            </div>
          </div>
          
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Last day Expenses</div>
          <div class="sales-details">
          
         
            
            <ul class="details">
            
            <li><?php $sql_command_yesterdayExp = "SELECT item, price , date FROM expenses Where date = '$yesterday_date' AND email = '$_SESSION[email]' ";
$result_y = mysqli_query($conn ,$sql_command_yesterdayExp);
$rows_y =  mysqli_num_rows($result_y);

if($rows_y > 0){
    while ($rows_y = mysqli_fetch_assoc($result_y) ){
        $yesterdayExp = $rows_y["price"];
        $yesterday_item = $rows_y["item"];
        echo "<tr> <th> $i  -   </th> <th>   $yesterday_item - </th> <th>   $yesterdayExp$</th> </tr> ";
        echo"<br>";
        echo"<br>";
        $i++;
    }
}?></li>
          </ul>
          <ul class="details">
           
          </ul>
          <ul class="details">
            
          </ul>
          </div>
          <div class="button">
            <a href="./monthwise-report.php">Search monthly expenses</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Income Report</div>
          <ul class="top-sales-details">
          <?php $sql_command_monthlyincome = "SELECT item,price , date FROM income Where date BETWEEN '$jan_date' AND '$lastday' AND email = '$_SESSION[email]' ORDER BY date ";
$result_z = mysqli_query($conn ,$sql_command_monthlyincome);
$rows_z =  mysqli_num_rows($result_z);

if($rows_z > 0){
    while ($rows_z = mysqli_fetch_assoc($result_z) ){
        $monthlyincome = $rows_z["price"];
        $monthly_item = $rows_z["item"];
        echo "<tr> <th>   </th> <th>   $monthly_item - </th> <th>   $monthlyincome$</th> </tr> ";
        echo"<br>";
        echo"<br>";
        $i++;
    }
}?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

 </script>

</body>
</html>

<?php 
require_once "include/footer.php";
?>