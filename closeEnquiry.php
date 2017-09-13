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
$enquiryNo = (int)$_POST['enquiryNo'];
echo $enquiryNo;
$updateEnquiries = "UPDATE enquiry set Status = 0, LastUpdate = CURRENT_TIMESTAMP WHERE EnquiryNumber = $enquiryNo ";
$update = mysqli_query($con,$updateEnquiries);
    if($update){
        
        echo' success';
    }
else{
    echo 'failure';
    
}
?>