<?php
session_start();
?>
<?php
include 'connection.php';
if (!(isset($_SESSION['status'])))
{
     header("Location:login.php?login=1");  
}



date_default_timezone_set('Europe/London');

$accountID = $_SESSION['accountID'];
$enquiryNo = (int)$_POST['EnquiryNo'];
$message = $_POST['message'];
$lastReply = 0;
$tenantID = 0;
$propertyID = 0;
$landlordID = 0;
$title = "";

$getinfo = "select max(replyNumber) as 'lastReply', tenant_ID, property_ID, landlord_ID, Title from enquiry where EnquiryNumber =  $enquiryNo";

$query = mysqli_query($con,$getinfo);

  while ($row = mysqli_fetch_assoc($query)){
    $lastReply = $row['lastReply'];  
    $tenantID = $row['tenant_ID'];    
    $lpropertyID = $row['property_ID'];  
    $landlordID = $row['landlord_ID'];  
    $title = $row['Title'];
  }

$lastReply++;


$UpdateSenders= "UPDATE enquiry set Sender_ID = $accountID  where EnquiryNumber = $enquiryNo";
$query = mysqli_query($con,$UpdateSenders);

if($query){
      echo' success';
    }
else{
    echo 'failure';
    
}
$insertmessage = "INSERT INTO enquiry (Title,Comment,tenant_ID,property_ID,Status,replyNumber,Sender_ID,EnquiryNumber,landlord_ID) VALUES ('$title','$message',$tenantID,$propertyID,1,$lastReply,$accountID,$enquiryNo,$landlordID)";



$update = mysqli_query($con,$insertmessage);
    if($update){
        
        echo' success';
    }
else{
    echo 'failure';
    
}

?>