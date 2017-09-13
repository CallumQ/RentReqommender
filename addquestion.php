<?php
session_start();
?>
<?php
include 'connection.php';
if (!(isset($_SESSION['status'])))
{
     header("Location:login.php?login=1");  
}

$enquiryNo = 0;

$getinfo = "select max(EnquiryNumber) as 'lastReply' from enquiry";

$query = mysqli_query($con,$getinfo);

  while ($row = mysqli_fetch_assoc($query)){
    $enquiryNo = (int)$row['lastReply'];  
  
  }


$enquiryNo++;


$title = $_POST['Title'];
$message = $_POST['Text'];
$landlordID = $_POST['landlordID'];
$propertyID = $_POST['propertyID'];
$accountID = $_SESSION['accountID'];
$tenantID = $_SESSION['accountID'];
$lastReply = $_SESSION['accountID'];

$insertmessage = "INSERT INTO enquiry (Title,Comment,tenant_ID,property_ID,Status,replyNumber,Sender_ID,EnquiryNumber,landlord_ID) VALUES ('$title','$message',$tenantID,$propertyID,1,$lastReply,$accountID,$enquiryNo,$landlordID)";

echo $insertmessage;

$update = mysqli_query($con,$insertmessage);
    if($update){
        
        echo' success';
    }
else{
    echo 'failure';
    
}