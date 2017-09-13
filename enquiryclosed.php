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
$offset = $_POST['offset'];

if ($_SESSION["status"] == 1){ 

$getnewEnquiries = "SELECT * from enquiry join tenant on enquiry.tenant_ID = tenant.User_ID  join landlord on landlord.User_ID = enquiry.landlord_ID  where enquiry.tenant_ID = ". $_SESSION['accountID']." AND status = 0 group by enquiry.EnquiryNumber  ORDER BY LastUpdate DESC  LIMIT 10 OFFSET $offset";
}
else{
    
$getnewEnquiries = "SELECT * from enquiry join tenant on enquiry.tenant_ID = tenant.User_ID  join landlord on landlord.User_ID = enquiry.landlord_ID  where enquiry.landlord_ID = ". $_SESSION['accountID']." AND status = 0 group by enquiry.EnquiryNumber  ORDER BY LastUpdate DESC  LIMIT 10 OFFSET $offset";
    
}
$enquiryQuery = mysqli_query($con,$getnewEnquiries);

while ($row = mysqli_fetch_assoc($enquiryQuery)){
    $date = date_create($row['LastUpdate']);
    
    ?>
<div class="enquiry-row" id="row-<?php echo $row['EnquiryNumber']?>">
                 <div class="enquiry-row-header-ID"><?php echo $row['EnquiryNumber']?></div>
    <div class="title-cover">
                <div class="enquiry-row-header-Title" title="<?php echo $row['Title']?>" style="    width: 280px;"><?php echo $row['Title']?></div></div>
                <div class="enquiry-row-header-Name"><?php echo $row['Forename'].' '. $row['Surname']?></div>
                 <div class="enquiry-row-header-date"><?php echo date_format($date, 'h:ia - d/m/y');  ?></div>
                <div class="enquiry-row-header-actions">
                    <div class="actions-close-perm" id="perma-close-<?php echo $row['EnquiryNumber']?>">Close Enquiry?
                    
                    <div class="actions-close-perm-right">
                        <div class="actions-close-yes" id="yes-close-<?php echo $row['EnquiryNumber']?>">Yes <i class="fa fa-check" aria-hidden="true"></i></div>
                        <civ class="actions-close-no" id="no-close-<?php echo $row['EnquiryNumber']?>">No <i class="fa fa-times" aria-hidden="true"></i></civ>
                        </div>
                    
                    </div>
                    
                    <div class="actions-expand action-button" id="expand-<?php echo $row['EnquiryNumber']?>">Expand <i class="fa fa-expand" aria-hidden="true"></i></div>
                    </div>
                 
                    
                    </div>

<div class="enquiry-expand enquiry-closed enquiry-minimised" id="expanded-<?php echo $row['EnquiryNumber']?>">
    <p class="enquiry-header"><strong>Title:</strong> <?php echo $row['Title']?></p><p class="enquiry-content"><strong>Comment:</strong> <?php echo $row['Comment']?></p>
<div class="enquiry-expand-property"></div>
   

</div>
 <div class="enquiry-reply enquiry-closed enquiry-minimised" id="replied-<?php echo $row['EnquiryNumber']?>">
     <div class="replied-confirmed" id="replied-confirmed-<?php echo $row['EnquiryNumber']?>">
         <div class="replied-confirmed-inner">
         
         Reply Sent<br><i class="fa fa-paper-plane" aria-hidden="true"></i></div></div>
     <label style="color: black;
    width: 100%;
    text-align: left;">
Reply
  <textarea placeholder="Reply here" id="text-area-<?php echo $row['EnquiryNumber']?>"></textarea>
</label>
     <div class="reply-send-button" id="send-button-<?php echo $row['EnquiryNumber']?>">Send</div>
</div>
<?php
}

?>

