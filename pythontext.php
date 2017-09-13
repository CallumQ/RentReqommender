<?php
session_start();
?>
<?php
include 'connection.php';?>
<?php 

$command = "test.py -u 1500";

exec($command,$response);
$incommand = " ";
for($i = 0; $i < sizeof($response); $i++){

    $incommand .= $response[$i] . ",";
    
}
$incommand = substr($incommand,0,-1);
?>


<!doctype html>
<html lang="en">

<head>


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
        
        
        
        function addToShortlist(element){
            var thenum = (element.id).replace( /^\D+/g, '');
            
            $.post("addtoshortlist.php",{propertyid:thenum},   
                   function(data){
                
                
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
                <ul class="sidebar-menu">
                  
                    <a href="propertysearch.php">
                    <li class="underline">Property Search
                    

                    </li></a>

                    <a href="shortlist.php"><li class="underline">Shortlist</li></a>
                    <a href="recommendation.php"><li class="underline">Recommendations</li></a>
                    <a href="enquiry.php"><li class="underline">Property Enquiries</li></a>
                    <a href="settings.php"><li class="underline">Settings</li></a>
                    <a href="logout.php"><li class="sidebar-menu-bottom underline"style=" border-top: 1px solid rgba(255,255,255,0.6);">Log Out</li></a>
                </ul>
            </div>
        
            <div class="advert-container1">
                
                <div class="header-content">
                <div class="header-content-pages">Showing page <span id="currentpage">1</span> of <span id="totalpage">10</span></div>
                <div class="header-content-selection">  <form>
                Sort by
                <select name="preference">
                <option value="Recent">Most recent</option>
                <option value="Highest">Highest Price</option>
                <option value="lowest">Lowest Price</option>
               
                
                
                
                </select>
                
                </form></div>
                
                
                    
                    
                    
                    
                    
                  
              
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                <?php
                
                
                
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM `advert` WHERE  advert_ID IN(".$incommand.")");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
            $hyperlink = '<a href="propertyview.php?advertID='.$row['advert_ID'].'">';
            $address = $row['address1'].", ". $row['address2'].", ".$row['address3'].', '.$row['postcode'];
            $price = $row['pricePerMonth'];
            $weeklyprice =round($price *12 / 52);
            $bedrooms = $row['bedroom'];
            $description = $row['description'];
            $noOfPics;
        $picturecount = mysqli_query($con,"SELECT COUNT(advertpicture.advert_ID) totalcount FROM advertpicture WHERE advertpicture.advert_ID =".$row['advert_ID']);    
        while($row2 = mysqli_fetch_assoc($picturecount)){
            $noOfPics = $row2['totalcount'];
        }
        
        //gets account type so the correct account overview is displayed
            //$_SESSION["status"] = $row["accountType"];
            //$_SESSION["accountID"] = $row["User_ID"];
         ?>
                
        <div class="advert-standard">
                   <?php echo"$hyperlink"?>
                <div class="advert-standard-picture">
             <img src="Image/examplepicture.png" width="250" class="rounded-edges">
                    <?php echo"</a>"?>
                       </div>
                <div class="advert-standard-picture-text"><i class="fa fa-camera" aria-hidden="true"></i>  <?php echo"$hyperlink"?><?php echo"$noOfPics"." Picture(s)";?> <?php echo"</a>"?><p></p></div>
                <div class="advert-standard-rightarea">
                    
                    <div class="advert-standard-rightarea-price"> <?php echo"$hyperlink"?>£<?php echo"$price"?> pcm (£<?php echo"$weeklyprice"?> pw) <?php echo"</a>"?></div>
                    <div class="advert-standard-rightarea-address">
                    <span class="bigger-ad-text grey-text">
                        <?php 
        
        echo"$address";?> 
                    
                    </span><br><span class="padding-left bigger-ad-text">
                        <i class="fa fa-bed" aria-hidden="true"></i> <?php
                if($bedrooms>1){
                    
                    echo"$bedrooms"." bedrooms";
                }
                else{
                    echo"$bedrooms"." bedroom";
                }
        ?><br>
                        </span>
                    </div>
                    <div class="advert-standard-rightarea-landlordpicture imageborder"><img src="Image/example.png"></div>
                    <div class="advert-standard-rightarea-likebutton" onclick="addToShortlist(this)" id="<?php 
                         echo"property-".$row['advert_ID'];?>">
                         
                         
                         
                   <p class="likebutton-text"><i class="fa fa-thumbs-up fa-2x liked" aria-hidden="true"></i><br>Like</p>
                    </div>
                     <?php echo"$hyperlink"?><div class="advert-standard-rightarea-viewbutton">
                    <p class="viewbutton-text"><i class="fa fa-eye fa-2x" aria-hidden="true"></i><br>View</p></div> <?php echo"</a>"?>
                    <div class="advert-standard-rightarea-description">
                    <span class="advert-description"><strong>Description</strong></span><br>
                        <?php
                        echo"$description"
                        
                        ?>
                    </div>
                    <div class="advert-standard-rightarea-keyfacts">
                    <ul class="keyfacts">
                    <li><strong>Features: </strong></li>
               <?php    if  ($row['childFriendly']){
                                echo"<li> kids allowed,</li>";
                        }
        if  ($row['furnsihed']){
                                echo"<li> furnished,</li>";
                        }
        if  ($row['garden']){
                                echo"<li> garden,</li>";
                        }
        if  ($row['disabled']){
                                echo"<li> disabled access,</li>";
                        }
        if  ($row['driveway']){
                                echo"<li> driveway,</li>";
        }
        if  ($row['pet']){
                                echo"<li> pets allowed,</li>";
                        }
       
                            ?>
                        </ul>                 
                    </div>
                    </div>
                
                </div>
            
        
        
        
        <?php   
    } }
      ?>          
                
               
                    
                    
                    
                    
                
               
                
                
                
                
              

        
</div>
   
    </div>
    </body>

    
    <script>
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