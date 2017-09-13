<?php
session_start();
?>

<?php
include 'connection.php';

$username =$_POST['email'];
$password =$_POST['password'];


    
    $select =mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$username'");
     $cRow = $select->num_rows;
    
    if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $checkuser = $row['email'];
        $checkpassword = $row['password'];
      
        if(password_verify($password,$checkpassword)){
            
            //gets account type so the correct account overview is displayed
            $_SESSION["status"] = $row["accountType"];
            $_SESSION["accountID"] = $row["User_ID"];
         
            if ($_SESSION["status"] == 1){
            echo '<script type="text/javascript">
           window.location = "http://callumquigley.com/Dissertation/account.php"
      </script>';
                
              
            }
            elseif($_SESSION["status"] == 2){
            echo'<script type="text/javascript">
           window.location = "http://callumquigley.com/Dissertation/landlordaccount.php"
      </script>';
              
                
                
            }
            }
        else{
            
            echo'<script type="text/javascript">
           window.location = "http://callumquigley.com/Dissertation/login.php?erorr=1"
      </script>';
           
        }
    }
        
        
           
    } else{
        echo '<script type="text/javascript">
           window.location = "http://callumquigley.com/Dissertation/login.php?error=1"
      </script>';
      
}
?>