<?php
session_start();
?>
<?php
include 'connection.php';

$User_ID = $_SESSION["accountID"];
$password = $_POST["newpassword"];


 $hashedpass = password_hash($password,PASSWORD_DEFAULT);
    $select =mysqli_query($con,"UPDATE users set password = '$hashedpass' WHERE User_ID = $User_ID");
    
    
if($select){
    
    echo'UpdateSuccess';
}
?>