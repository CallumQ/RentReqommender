<?php
session_start();
?>
<?php
       include 'connection.php';   
$user_ID = $_SESSION['accountID'];
$thumbnail = $_POST['filepath'];
$description = $_POST['description'];
$phoneno = $_POST['phoneno'];
$forename = $_POST['Forename'];
$surname = $_POST['Surname'];
$email = $_POST['email'];
$email = trim($email);
$checkEmail ="SELECT * from users where email = \"". $email."\" AND User_ID <> $user_ID";
$flag = 0;
$getRows = mysqli_query($con,$checkEmail);
$cRow = $getRows->num_rows;
    
        if($cRow >=1){
          while ($row = mysqli_fetch_assoc($getRows)){
            
         
              if ($row['email'] == $email){
              $flag = 1;
              
          }     
              
          }}

if($flag == 1){
    
    echo'emailExists';
}
else{
    
    $updateInfo = "UPDATE users set email = '$email' WHERE User_ID = $user_ID";
    
    $result = mysqli_query($con,$updateInfo);
    
    if($result){
     
        
        
        
    }
    else{
        echo' error';
    }
    

  
   

    
    
    
    $updateTenant = "UPDATE landlord set AgencyName = '$forename', ContactName = '$surname', description = '$description', PhoneNo = '$phoneno' WHERE User_ID = $user_ID";
   
    $result = mysqli_query($con,$updateTenant);
    if($result){
        echo 'UpdateSuccess';
        
        
        
    }
    else{
        echo' error';
    }
}
?>