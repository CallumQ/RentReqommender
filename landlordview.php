<?php
session_start();
?>
<?php
include 'connection.php';
if (!(isset($_SESSION['status'])))
{
     header("Location:login.php?login=1");  
}

?>
<!doctype html>
<html lang="en">

<head>
   
    <link rel="apple-touch-icon" sizes="57x57" href="/Image/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/Image/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/Image/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/Image/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/Image/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/Image/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/Image/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/Image/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/Image/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/Image/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/Image/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Image/favicon-16x16.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Rent ReQommender - Personalised property suggestions</title>
    <script type="text/javascript">
    var landlordID = <?php echo $_GET['landlordID'] ?>;
    var tenantID = <?php echo $_SESSION['accountID'] ?>;
        function yesnoCheck() {
            if (document.getElementById('AccountTenant').checked) {
                document.getElementById('tenant-registerform').style.display = 'block';
            } else {
                document.getElementById('tenant-registerform').style.display = 'none';


            }
            if (document.getElementById('AccountLandlord').checked) {
                document.getElementById('LandLord-registerform').style.display = 'block';


            } else {
                document.getElementById('LandLord-registerform').style.display = 'none';

            }
        }
        
        
        
        function removeFromShortlist(element){
            var thenum = (element.id).replace( /^\D+/g, '');
            
            $.post("removefromshortlist.php",{propertyid:thenum},   
                   function(data){
                    
                  $('#parent'+thenum).fadeOut(1000, function() { $('#parent'+thenum).remove();});
                
            });
            
            
            return false;
            
        }

    </script>
    
    
</head>

<body>

    <div class="nav-bar" id="nav-bar">
        <div class="nav-bar-left">
            <a href="index.php">
                <img src="Image/logoplaceholder.png">
            </a>
        </div>

        <div class="nav-bar-right">
            <ul class="nav-bar-right-menu">

                <li> <a href="account.php" class="sliding-u-l-r">Account</a></li>
                <li class="nav-bar-button-outer"> <a href="logout.php" class="nav-bar-button">Log out</a></li>
            </ul>
        </div>
    </div>

    <div class="main-body-content">
    
             <div class="sidebar">
                <ul class="sidebar-menu" style="margin-left:0px;">
                  
                    <a href="propertysearch.php">
                    <li class="underline">Property Search
                    

                    </li></a>

                    <a href="shortlist.php"><li class="underline">Shortlist</li></a>
                    <a href="recommendation.php"><li class="underline">Recommendations</li></a>
                    <a href="enquiry.php"><li class="underline">Property Enquiries</li></a>
                    <a href="settings.php"><li class="underline">Settings</li></a>
                    <a href="logout.php"><li class="sidebar-menu-bottom underline"style=" border-top: 1px solid rgba(255,255,255,0.6); width:100%;">Log Out</li></a>
                </ul>
            </div>
          
            <div class="advert-container1">
        <div class="landlord-header">
             <?php
                $landlordInfo = mysqli_query($con,"SELECT * FROM landlord where User_ID =".$_GET['landlordID']);
                if ($landlordInfo->num_rows){
                    while($landlordRow = mysqli_fetch_assoc($landlordInfo)){
                    
                
    
                ?>
            <div class="landlord-header-image">
            <img src="<?php echo $landlordRow['thumbnail'] ?>" class="rounded-edges" style="object-fit:contain; height:246px; width:250px; background:white; top: 0px; left:1px;">
            
            </div>
            <div class="landlord-header-right-section">
                <div class="container-right top-right">
                 <div class="star-container ">
                             <?php 
                    
                     $avgratings = mysqli_query($con,"SELECT count(*) as'count', AVG(overallRating) as 'avg' FROM `landlordratings` where landlord_ID = ". $_GET['landlordID']);
                     $dRow = $avgratings->num_rows;
                 if($dRow >= 1){

                   
    while ($row4 = mysqli_fetch_assoc($avgratings)){
            $stars = $row4['avg'];        
        for($i = 0; $i < 5;$i++){
            if ($stars >= 1){
                echo'  <div class="star"></div>';        
                $stars--;
            }
            elseif($stars >= 0.5 && $stars < 1){
                 echo'  <div class="half-star"> <div class="empty-star"></div></div>';
            }
            
            if ($stars == 0 && $i < 4){
                 echo'   <div class="empty-star"></div>';
                
            }
            }
        
   
                     ?>
                        </div>
                    <div class="container-right-ratings-number">
                        <?php 
            echo $row4['count'].' ratings';
        
        
         }}?>
                         </div>
                            </div>
               
                <p class="landlord-name"><strong> <?php echo $landlordRow['AgencyName'];?> </strong>
                
                </p>
                
                <p class="landlord-contact-details" style="margin-bottom:0;"><strong>Contact name:</strong> <?php echo $landlordRow['ContactName'];?> <br><strong>Contact No:</strong> <?php echo $landlordRow['PhoneNo']?></p>
                <strong>Description:</strong>
                <p class="description"><?php echo $landlordRow['description']?></p>
            
            <?php
                }}
            ?>
            </div>
            
            
       
        </div>
                 <div class="landlord-buttons">
            <div class="landlord-properties landlordbutton propertybutton" id="propertyButton">
                <p>Properties</p>
            </div>
            <div class="landlord-reviews landlordbutton review-button" id="reviewButton"><p>Reviews</p></div>
            </div>
                <div class="adverts-section">
                <?php
                
                
                
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM advert where advert.landlord_ID=".$_GET['landlordID']."");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){

                     
    while ($row = mysqli_fetch_assoc($select)){
        $parentID = 'parent'.$row['advert_ID'];
          $landlordPicture = "";
        $bathroom = $row['bathrooms'];   
        $hyperlink = '<a target="_blank" href="propertyview.php?advertID='.$row['advert_ID'].'" style=" color: black;">';
            $address = $row['address1'].", ". $row['address2'].", ".$row['address3'].', '.$row['postcode'];
            $price = $row['pricePerMonth'];
            $weeklyprice =round($price *12 / 52);
            $bedrooms = $row['bedroom'];
            $description = $row['description'];
         $landlordlink = '<a target="_blank" href="landlordview.php?landlordID='.$row['landlord_ID'].'" style=" color: black;">';
        
        if(strlen($description) > 350 ){
            $description = substr($description,0,347);
            $description .= "...";
            
            
        }
            $noOfPics;
        $picturecount = mysqli_query($con,"SELECT COUNT(advertpicture.advert_ID) totalcount FROM advertpicture WHERE advertpicture.advert_ID =".$row['advert_ID']);    
        
        
        while($row2 = mysqli_fetch_assoc($picturecount)){
            $noOfPics = $row2['totalcount'];
        }
        
        
        $landlordpicturequery = mysqli_query($con, "SELECT landlord.thumbnail from landlord where landlord.User_ID =". $row['landlord_ID']);
        while($row3 = mysqli_fetch_assoc($landlordpicturequery)){
            $landlordpicture = $row3['thumbnail'];
            
        }
        
        //gets account type so the correct account overview is displayed
            //$_SESSION["status"] = $row["accountType"];
            //$_SESSION["accountID"] = $row["User_ID"];
         ?>
                
          <div class="advert-standard" id="<?php echo $parentID ?>">
            <div class="advert-standard-left-container">
            
                <div class="advert-standard-left-container-propertyimage">
                            <?php
                        
                          $GetThumbnail = "SELECT advertPictureUrl FROM `advertpicture` WHERE advert_ID=". $row['advert_ID']. " LIMIT 1"; 
                      
                $getRows2 = mysqli_query($con,$GetThumbnail);
                $zRow = $getRows2->num_rows;
            
        if($zRow >= 1){
                     while ($rowsss = mysqli_fetch_assoc($getRows2)){
                        echo"$hyperlink";
                    echo'<img src="'.$rowsss['advertPictureUrl'].'" class="rounded-edges" style="object-fit:contain; height:248px; background:black;">';
                         echo'</a>';
                 }
                 }
        
        else{
            echo"$hyperlink";
            echo'<img src="Image/thumbnailNoImage.png" class="rounded-edges" style="object-fit:contain; height:246px; width:250px; background:white; top: 1px;">';
            echo'</a>';
        }
                    
                    ?></div>
                    <div class="advert-standard-left-container-imagecount">
                        
                        
                    <div class="imagecount-value">    
                          <?php echo"$hyperlink"?><i class="fa fa-camera" aria-hidden="true"></i><?php echo" $noOfPics"." Picture(s)";?> <?php echo"</a>"?>
                     
                    </div>
                    
                    </div>    
                </div>
            <div class="advert-standard-middle-container">
            <div class="advert-standard-middle-container-top">
                <span class="bigger-ad-text grey-text">
                        <?php echo"$hyperlink";
        
        echo"$address";
                    echo '</a>';
                    ?> 
                    
                    </span>
                <div class="advert-standard-rightarea-price">
                <?php echo"$hyperlink"?>£<?php echo"$price"?> pcm (£<?php echo"$weeklyprice"?> pw) <?php echo"</a>"?>
                </div>
                </div>
                 <div class="advert-standard-middle-container-middle"><span class="padding-left bigger-ad-text">
                        <i class="fa fa-bed" aria-hidden="true"></i> <?php
                        
                if($bedrooms>1){
                    
                    echo"$bedrooms"." bedrooms ";
                }
                else{
                    echo"$bedrooms"." bedroom ";
                }
        ?>
                     <i class="fa fa-bath" aria-hidden="true" style="padding-left:10px;"></i> <?php
                if($bathroom>1){
                    
                    echo"$bathroom"." bathrooms ";
                }
                else{
                    echo"$bathroom"." bathroom ";
                }?><br><strong>Description</strong><br>
                     <p style="font-size:17px;">
                     <?php echo $description;?>
                                                
                        </p>
                        </span></div>
                <div class="advert-standard-middle-container-bottom"><ul class="keyfacts">
                    <li><strong>Features: </strong></li>
               <?php    if  ($row['childFriendly']){
                                echo"<li> kids allowed</li>";
                        }
        if  ($row['furnsihed']){
                                echo"<li> furnished</li>";
                        }
        if  ($row['garden']){
                                echo"<li> garden</li>";
                        }
        if  ($row['disabled']){
                                echo"<li> disabled access</li>";
                        }
        if  ($row['driveway']){
                                echo"<li> driveway</li>";
        }
        if  ($row['pet']){
                                echo"<li> pets allowed</li>";
                        }
        if  ($row['smoker']){
                                echo"<li> smokers allowed</li>";
            
        }
       
                            ?>
                        </ul>     </div>
            </div>
            <div class="advert-standard-right-container">
            <div class="advert-standard-right-container-top">
                <?php echo $landlordlink; ?>
                <img src="<?php echo $landlordpicture?>" style="
    height: 250px;
    object-fit: contain;
    max-width: 100%;
    max-height:100%;
                                                                "><?php echo '</a>';?>
                </div>
                 <div class="advert-standard-right-container-bottom">
                <div class="advert-standard-right-container-bottom-like" onclick="addToShortlist(this)" id="<?php 
                         echo"property-".$row['advert_ID'];?>"><p class="likebutton-text"><i class="fa fa-thumbs-up  fa-2x liked" aria-hidden="true"></i><span style="padding-left:15px; font-size:25px;">Like</span></p>
                     
                     </div>
                     <?php echo"$hyperlink"?>
                <div class="advert-standard-right-container-bottom-view" >
                     <p class="likebutton-text"><i class="fa fa-eye  fa-2x liked" aria-hidden="true"></i><span style="padding-left:15px; font-size:25px;">View</span></p>
                     
                     </div>
                     <?php echo '</a>';?>
                </div>
                
            </div>
            
</div>
        
        
        <?php   
    }  }
      ?>
                
                </div>    
                <div class="review-section">
                <div class="review-section-button"><p id="review-text">Add a Review     <i class="fa fa-plus" aria-hidden="true"></i></p>
                    
                    
                    </div>
                    
                <div class="review-section-reviewarea">
                    <div class="review-cover">
                    <div class="review-cover-container">
                    
                        </div>
                    </div>
                    <div class="row ratings-area">
                    <div class="medium-4 columns">
                        <p>  Availability</p>
                        <div class="rating">
  <label>
    <input type="radio" name="Availability" value="5" title="5 stars"> 5
  </label>
  <label>
    <input type="radio" name="Availability" value="4" title="4 stars"> 4
  </label>
  <label>
    <input type="radio" name="Availability" value="3" title="3 stars"> 3
  </label>
  <label>
    <input type="radio" name="Availability" value="2" title="2 stars"> 2
  </label>
  <label>
    <input type="radio" name="Availability" value="1" title="1 star"> 1
  </label>
</div>
                        </div>
                    <div class="medium-4 columns">
                        <p> Approachability</p>
                        <div class="rating2">
  <label>
    <input type="radio" name="Approachability" value="5" title="5 stars"> 5
  </label>
  <label>
    <input type="radio" name="Approachability" value="4" title="4 stars"> 4
  </label>
  <label>
    <input type="radio" name="Approachability" value="3" title="3 stars"> 3
  </label>
  <label>
    <input type="radio" name="Approachability" value="2" title="2 stars"> 2
  </label>
  <label>
    <input type="radio" name="Approachability" value="1" title="1 star"> 1
  </label>
</div>
                        </div>
                    <div class="medium-4 columns">
                        <p>  Maintenance</p>
                        <div class="rating3">
  <label>
    <input type="radio" name="Maintenance" value="5" title="5 stars"> 5
  </label>
  <label>
    <input type="radio" name="Maintenance" value="4" title="4 stars"> 4
  </label>
  <label>
    <input type="radio" name="Maintenance" value="3" title="3 stars"> 3
  </label>
  <label>
    <input type="radio" name="Maintenance" value="2" title="2 stars"> 2
  </label>
  <label>
    <input type="radio" name="Maintenance" value="1" title="1 star"> 1
  </label>
</div>
                        </div>
                    
                    </div>
                    <div class="medium-12 columns">
                       <label style="color: black;">Comments<br>
                    <span id ="description">         
                        <textarea name='comment' id='Comment' cols='40' rows='4' placeholder="General feedback comments"></textarea> </span></label></div>
                    <div class="medium-6 medium-centered" style="text-align:center; margin-bottom:10px;">
                    
                    <p>Overall rating</p>
                    
                    <div class="rating4">
  <label>
    <input type="radio" name="overallrating" value="5" title="5 stars"> 5
  </label>
  <label>
    <input type="radio" name="overallrating" value="4" title="4 stars"> 4
  </label>
  <label>
    <input type="radio" name="overallrating" value="3" title="3 stars"> 3
  </label>
  <label>
    <input type="radio" name="overallrating" value="2" title="2 stars"> 2
  </label>
  <label>
    <input type="radio" name="overallrating" value="1" title="1 star"> 1
  </label>
</div>
                    </div>
                    <div class="medium-6 medium-centered" style="text-align:center;">
                    
                    <div class="button" id="submit-review" style="width: 100%;">submit</div></div>
                    
                 
                </div>
                    <?php  $select =mysqli_query($con,"SELECT * FROM landlordratings  join tenant on tenant.User_ID = landlordratings.tenant_ID where landlordratings.landlord_ID=".$_GET['landlordID']."");
                    
                    
                     while ($row2 = mysqli_fetch_assoc($select)){
                    
                    ?>
                       
                    <div class="review-section-reviews">
                        
                    
                    <div class="review-item">
                        <div class="review-section-item-header"><p style="margin-bottom:5px;"><strong><?php echo $row2['Forename'].' '. $row2['Surname'] ?></strong></p></div><br>
                        <div class="review-section-item-header" style="width:100%;"><p class="textarea-comment"><strong>Comments</strong></p><div id="textarea"><?php echo $row2['comments'] ?></div></div><br>
                <div class="review-section-item-header"><p>Availability</p><div >
 
</div>
                 
                    <div class="star-container">
                        <?php 
                             for($i = 0; $i < $row2['availability']; $i++){
                                 echo'  <div class="star"></div>';
                                 
                             }
                            for ($i = 0; $i < 5- $row2['availability']; $i++){
                                
                                echo'   <div class="empty-star"></div>';
                            }
                        
                        ?>
                           

                    
                            </div></div>
                <div class="review-section-item-header"><p>Approachability</p><div>
  
</div>
                     <div class="star-container">
                              <?php 
                             for($i = 0; $i < $row2['approachable']; $i++){
                                 echo'  <div class="star"></div>';
                                 
                             }
                            for ($i = 0; $i < 5- $row2['approachable']; $i++){
                                
                                echo'   <div class="empty-star"></div>';
                            }
                        
                        ?></div>
                            </div>
                <div class="review-section-item-header"><p>Maintenance</p><div>
                     <div class="star-container">
   <?php 
                             for($i = 0; $i < $row2['maintenance']; $i++){
                                 echo'  <div class="star"></div>';
                                 
                             }
                            for ($i = 0; $i < 5- $row2['maintenance']; $i++){
                                
                                echo'   <div class="empty-star"></div>';
                            }
                        
                        ?></div>
                   
 
</div></div>
                            <div class="review-section-item-header overall-rating"><p>Overall rating</p><div>
                                 <div class="star-container">
                                   <?php 
                             for($i = 0; $i < $row2['overallRating']; $i++){
                                 echo'  <div class="star"></div>';
                                 
                             }
                            for ($i = 0; $i < 5- $row2['overallRating']; $i++){
                                
                                echo'   <div class="empty-star"></div>';
                            }
                        
                        ?>
                                </div>
</div></div><br>
                
            
                </div> <?php } ?></div>
              </div>
                
        
</div>
  
    </div>
    </body>

    
    <script>
         
        
        $('#submit-review').click(function(){
            
            var available = $('input[name=Availability]:checked').val();
            var approachability = $('input[name=Approachability]:checked').val();
            var maintenance = $('input[name=Maintenance]:checked').val();
            var overallrating = $('input[name=overallrating]:checked').val();
            var comments = $('#Comment').val();
            
            if (!(isNaN(available))&&(!(isNaN(approachability)))&&(!(isNaN(maintenance)))&&(!(isNaN(overallrating)))){
                $('.review-cover-container').append('<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span><p>Submitting review...</p>');
             
                
                   $('.review-cover').css('display','block');
                
                $.post("insertlandlordrating.php", {available:available,approachability:approachability,maintenance:maintenance,overallrating:overallrating,Comments:comments,landlordID:landlordID,tenantID:tenantID}, function(data) {
                    if(data == 'success'){
                        
                        $('.review-cover-container').html('');
                $('.review-cover-container').append('<i class="fa fa-check-circle" aria-hidden="true"></i><p>Thanks for the review!</p></div>');
                    
                    
                    }
                        
                });
                return false;
                
            
            }
            else{
               
                
            }
            
            
        });
        $('.rating input').change(function () {
  var $radio = $(this);
  $('.rating .selected1').removeClass('selected1');
  $radio.closest('label').addClass('selected1');
            
});
                $('.rating2 input').change(function () {
  var $radio = $(this);
  $('.rating2 .selected1').removeClass('selected1');
  $radio.closest('label').addClass('selected1');
            
});
                $('.rating3 input').change(function () {
  var $radio = $(this);
  $('.rating3 .selected1').removeClass('selected1');
  $radio.closest('label').addClass('selected1');
            
});
                $('.rating4 input').change(function () {
  var $radio = $(this);
  $('.rating4 .selected1').removeClass('selected1');
  $radio.closest('label').addClass('selected1');
            
});
        
        
        var textcounter = 0;
        $(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});
        function showreviewSection(){
              
            
        }
function makefixed(){
    console.log("heojhweoij");
    document.getElementById("side-bar").style.position = "fixed";
    
    
}
function function2(){
    
    var height =$( window ).height();
    $("#side-bar").animate({height:height+'px'},100);
    return this;
}
        function propertyButtonSelected(){
             document.getElementById("propertyButton").className += " selected";
          document.getElementById("reviewButton").className =
   document.getElementById("reviewButton").className.replace
      ( /(?:^|\s)selected(?!\S)/g , '' );
          $(".adverts-section").css("display","block");    
          $('.review-section-button').css('display','none');
            $('.review-section').css('display','none');
            
        }
        function reviewButtonSelected(){
               document.getElementById("reviewButton").className += " selected";
            document.getElementById("propertyButton").className =
   document.getElementById("propertyButton").className.replace
      ( /(?:^|\s)selected(?!\S)/g , '' );
             $(".adverts-section").css("display","none");    
             $('.review-section-button').css('display','block');
            $('.review-section').css('display','block');
        }
        
        function changeheight(){
              
            $('.landlord-header').css('height',$('.landlord-header-right-section').height());
            
            
        }
        
         $( window ).resize(function() {
         changeheight();
         
         });
 $(function () { // DOM ready
     changeheight();
    
        
     propertyButtonSelected();
 $('.review-section-button').click(function(){
     if (textcounter == 0){
         $('#review-text').text("Cancel ");
          textcounter = 1;
     }
     else{
        $('#review-text').text("Add a Review ");
         $('#review-text').append('<i class="fa fa-plus" aria-hidden="true"></i>');
         textcounter = 0;
         
     }
     $('.review-section-reviewarea').slideToggle(10,"linear",function(){
        
     });
     
 });
      $("#propertyButton").click(function() {  
         propertyButtonSelected();
      });
      $("#reviewButton").click(function() { 
   reviewButtonSelected();
      });  
     
     
     window.addEventListener('scroll', function (e) {
                var distanceY = window.pageYOffset || document.documentElement.scrollTop
                    , shrinkOn = 80;
                    if (distanceY > shrinkOn) {    
                    function2(function() {
          makefixed();
        });
                if( distanceY <= shrinkOn){
                   
                        document.getElementById("side-bar").style.position = "absolute";
                    }
                    }
                    
                
                    });
 }); 
        
</script>
</html>