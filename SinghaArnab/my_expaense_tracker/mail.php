<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
  }

  ?>




<?php

$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(ExpenseCost)  as monthlyexpense from tblexpense where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_expense=$result3['monthlyexpense'];


// echo $row['Name'];



$uid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select FullName,Email from tbluser where ID='$uid'");
$row=mysqli_fetch_assoc($ret);
$Name=$row['FullName'];
$Email=$row['Email'];




$to_email = "$Email";
$subject = "your mothly expense";
$body ="

Dear $Name...,

I hope you’re well. Please see Your Expenses in this Month.your Total Expenses is :-  $sum_monthly_expense...
For more details You can download Invoice From Our Website.

Don’t hesitate to reach out if you have any querry.

Kind regards,
Expense Tracker

uic.21mca2445@gmail.com";
$headers = "From:uic.21mca2445@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    
    echo "<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Mail Sent to $to_email...');
    window.location.href='dashboard.php';
    </script>"; 
    ;
   

} else {
    echo "Email sending failed...";
}


?>