<?php
session_start();
?>

<?php
include 'connection.php';



$User_ID = $_SESSION["accountID"];
$password = $_POST["currentpassword"];
    $select =mysqli_query($con,"SELECT * FROM `users` WHERE User_ID = $User_ID");
     $cRow = $select->num_rows;
    
    if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $checkuser = $row['email'];
        $checkpassword = $row['password'];
        
        if(password_verify($password,$checkpassword)){
            
            echo'Match';
         
         
        
        
           
    } }}
?>