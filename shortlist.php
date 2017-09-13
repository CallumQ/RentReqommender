<?php
session_start();
?>

<?php
include 'connection.php';
if (!(isset($_SESSION['status'])))
{
     header("Location:login.php?login=1");  
}
else{
     if ($_SESSION["status"] != 1){
             header("Location:landlordaccount.php");
     }
    
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
                    
                  $('#property-container'+thenum).fadeOut(1000, function() { $('#property-container'+thenum).remove();});
                
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
                     <a href="userenquiry.php"><li class="underline">Property Enquiries</li></a>
                    <a href="settings.php"><li class="underline">Settings</li></a>
                    <a href="logout.php"><li class="sidebar-menu-bottom underline"style=" border-top: 1px solid rgba(255,255,255,0.6); width:100%;">Log Out</li></a>
                </ul>
            </div>
        
            <div class="advert-container1">
      
                
                <?php
                
                
                
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM shortlist JOIN advert on shortlist.advert_ID = advert.advert_ID where shortlist.user_ID =".$_SESSION['accountID']."");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){

                     
     while ($row = mysqli_fetch_assoc($select)){
        $bathroom = $row['bathrooms'];   
        $landlordPicture = "";
        $hyperlink = '<a target="_blank" href="propertyview.php?advertID='.$row['advert_ID'].'" style=" color: black;">';
            $address = $row['address1'].", ". $row['address2'].", ".$row['address3'].', '.$row['postcode'];
            $price = $row['pricePerMonth'];
            $weeklyprice =round($price *12 / 52);
            $bedrooms = $row['bedroom'];
            $description = $row['description'];
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
               
        <div class="advert-standard" id="<?php   echo"property-container".$row['advert_ID'];?>">
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
            <div class="advert-standard-right-container-top"><img src="<?php echo $landlordpicture?>" style="
    height: 250px;
    object-fit: contain;
    max-width: 100%;
    max-height:100%;
"></div>
                 <div class="advert-standard-right-container-bottom">
                <div class="advert-standard-right-container-bottom-dislike" onclick="removeFromShortlist(this)" id="<?php 
                         echo"property-".$row['advert_ID'];?>"><p class="likebutton-text"><i class="fa fa-times  fa-2x liked" aria-hidden="true"></i><span style="padding-left:15px; font-size:25px;">Remove</span></p>
                     
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
   
    </div>
    </body>

    
    <script>
        
        $(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});
function makefixed(){
    console.log("heojhweoij");
    document.getElementById("side-bar").style.position = "fixed";
    
    
}
function function2(){
    
    var height =$( window ).height();
    $("#side-bar").animate({height:height+'px'},100);
    return this;
}
 $(function () { // DOM ready
 
     
     
     
     
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