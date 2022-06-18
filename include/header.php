<?php

    session_start();

    if( !$_SESSION["email"] ){
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Income and Expense Management System</title>
    
    <link href="./resorce/css/style.css" rel="stylesheet">

    <style> 
     .hidden {
       
         display: none;
     }
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

     





    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        <!-- ***********************************-->
  
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
      
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="style2.css">
  
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>


  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">I.A.E.M</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="./index.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./add-income.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Incomes</span>
          </a>
        </li>
        <li>
          <a href="./add-expense.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Expenses</span>
          </a>
        </li>
        <li>
          <a href="./profile.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="./add_budget.php">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Budgets</span>
            
          </a>
        </li>
        <li>
          <a href="./daywise-report.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Trackers</span>
          </a>
        </li>
        <li>
          <a href="./calender.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Calander</span>
          </a>
        </li>
        <li>
          <a href="./graph.php">
            <i class='bx bx-message' ></i>
            <span class="links_name">Graphs</span>
          </a>
        </li>
        <li>
          <a href="./manage-expense.php">
            <i class='bx bx-heart' ></i>
            <span class="links_name">Manage expense</span>
          </a>
        </li>
        
        <li class="log_out">
          <a href="include/logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
           
          </a>
        </li>
      </ul>
  </div>
  

      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name">Dip</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">



        <div class="modal fade" id="showModal" data-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="modalHead" class="modal-header">
                    <button id="modal_cross_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p id="addMsg"></p>
                </div>
                <div class="modal-footer ">
                    <div class="mx-auto">
                        <a type="button" id="changeHrefForAdding" href="#" class="btn btn-primary" >Add Expense For the Day</a>
                        <a type="button" id="changeHrefToShowReport" href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
            <!-- row -->

            <div class="container-fluid">

            