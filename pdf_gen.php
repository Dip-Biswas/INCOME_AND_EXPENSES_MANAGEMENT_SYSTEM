<?php 
      session_start();
      require_once 'include/database-connection.php';
      require 'fpdf/fpdf.php';
      

    $thirdDate = $forthDate = "";
    $firstDate = $_GET["firstDay"];
    $lastDate = $_GET["lastDay"];
   

   if($lastDate > $firstDate){

        $firstDate = $firstDate;
        $lastDate = $lastDate;

    } else {
        $thirdDate = $firstDate;
        $forthDate = $lastDate;

        // swapping dates
        $firstDate = $forthDate;
        $lastDate = $thirdDate;
        
    }
    
    $sql_query = "SELECT date , item , price FROM expenses WHERE date   BETWEEN '$firstDate' AND '$lastDate' AND email = '$_SESSION[email]' ORDER BY date " ;
    $result = mysqli_query($conn , $sql_query ) ;
    $row = mysqli_num_rows($result);

    $firstDate = date('jS F, Y' ,strtotime($firstDate));
    $lastDate = date('jS F, Y' ,strtotime($lastDate));

    $name = ucwords($_SESSION["name"]);
    $current_date = date('jS F, Y' ,strtotime('now'));

    ob_start();
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',25);
    $i=1;
    $pdf->Cell(190,70,"Expense Management System" ,'' , '0' ,'C'); 
    $pdf->Ln(60);
    $pdf->SetFont('Arial','',18);
    $pdf->Cell(40,10,"Client Name : " ,'' , '0' ,'C');
    $pdf->Cell(24,10,"$name" ,'' , '0' ,'C');
    $pdf->Ln();
    
    $pdf->Cell(40,10,"Current Date : " ,'' , '0' ,'C');
    $pdf->Cell(45,10,"$current_date" ,'' , '0' ,'C');
    $pdf->Ln(40);

    $pdf->Cell(190,10,"Invoice Between :" ,'' , '0' ,'C');
    $pdf->Ln();
    $pdf->Cell(190,10,"$firstDate and $lastDate" ,'' , '0' ,'C');
    $pdf->Ln(50);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(47,10,"S.No." ,'1' , '0' ,'C');
    $pdf->Cell(47,10,"Date" ,'1' , '0' ,'C');
    $pdf->Cell(47,10,"Item" ,'1' , '0' ,'C');
    $pdf->Cell(47,10,"Price in $" ,'1' , '0' ,'C');
    $pdf->Ln(10);   

    while( $row = mysqli_fetch_assoc($result)){     
        
        $pdf->Cell(47,10,$i ,'1' , '0' ,'C'); 
        $pdf->Cell(47,10,$row['date'] ,'1' , '0' ,'C') ; 
        $pdf->Cell(47,10,$row['item'] ,'1' , '0' ,'C');
        $pdf->Cell(47,10,$row['price'] ,'1' , '0' ,'C');    
        $pdf->Ln(10);   
        $i++;   
    }
    $pdf->Output();
    ob_end_flush();


?>
