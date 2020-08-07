<?php
$host="192.168.27.88";
$user="Mars";
$password="27272727";
$db = "rent-tech";

$con = mysqli_connect($host,$user,$password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{  //echo "Connect"; 
  
   
   }

?>