<?php
session_start();
?>
<?php
include 'connection.php';



$available = $_POST['available'];
$approachability = $_POST['approachability'];
$maintenance = $_POST['maintenance'];
$overallrating = $_POST['overallrating'];
$Comments = $_POST['Comments'];
$landlordID = $_POST['landlordID'];
$tenantID = $_POST['tenantID'];

$insertString ="
INSERT INTO landlordratings (availability,approachable,maintenance,overallRating,comments,tenant_ID,landlord_ID) values($available,$approachability,$maintenance,$overallrating,'$Comments', $tenantID,$landlordID)";

$insertProperty =mysqli_query($con,$insertString);

    if($insertProperty){
        echo'success';}
else{
    
    echo' error';
}

?>