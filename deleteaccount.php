<?php
session_start();
?>
<?php
include 'connection.php';

$User_ID = $_SESSION["accountID"];




    $select =mysqli_query($con,"DELETE FROM users WHERE User_ID = $User_ID");
    
    
if($select){
    $select2 =mysqli_query($con,"DELETE FROM tenant WHERE User_ID = $User_ID");
    if($select2){
        $select3 =mysqli_query($con,"DELETE FROM shortlist WHERE User_ID = $User_ID");
        if($select3){
            
            echo'Success';
        }
    }
}
?>