<?php

$con=new mysqli("localhost","example3_rentrec","password1234","example3_rentreq");// Connect to the host Connect to the host


      // Check connection
 if ($con->connect_errno){
     printf("Connection failed");
     exit();
     
     
 }
 $tableList = array();
  $res = mysqli_query($con,"SHOW TABLES");
  while($cRow = mysqli_fetch_array($res))
  {
    //echo "$cRow[0]\n";
   
  }
    



?>
