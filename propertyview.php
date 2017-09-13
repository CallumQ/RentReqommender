<?php
session_start();
?>
<?php
include 'connection.php';
$propertyid= $_GET['advertID'];



 
                 $select =mysqli_query($con,"SELECT * FROM advert where advert.advert_ID = $propertyid LIMIT 10");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
         $landlordlink = '<a target="_blank" href="landlordview.php?landlordID='.$row['landlord_ID'].'" style=" color: black;">';
           $price = $row['pricePerMonth'];
            $weeklyprice =round($price *12 / 52);
            $bedrooms = $row['bedroom'];
            $description = $row['description'];
            $noOfPics;
       $bathroom = $row['bathrooms'];   
        $landlordRatings = $row['landlord_ID'];
        
        $picturecount = mysqli_query($con,"SELECT COUNT(advertpicture.advert_ID) totalcount FROM advertpicture WHERE advertpicture.advert_ID =".$row['advert_ID']);    
        while($row2 = mysqli_fetch_assoc($picturecount)){
            $noOfPics = $row2['totalcount'];
        }
        
        
        
        
    ?>    
<script>

var landlordID = <?php echo $row['landlord_ID']; ?>;

var propertyID= <?php echo $propertyid;?>;

</script>
    
    
    
<html>
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
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAWu9ZhEzpYLrUPQUGFZ5ZFvKENLNOPu-g"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
        <link rel="stylesheet" href="css/foundation.css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/index.css">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Rent ReQommender - Personalised property suggestions</title>
         <style>
       
    </style>
    </head>
    
    
    
<body>
    <div class="form-container">
    <div class="row form-container-inner">
        
        
        <div class="medium-4 medium-centered columns form-container-inner">
            <div class="form-container-inner-inner">
                <i class="fa fa-times fa-times-enquiry" aria-hidden="true"></i>
            
            <p>Enquiry Form</p>
       <div class="medium-12 columns">
      <label>Title:
        <input type="text" placeholder="Question Title" id="form-title">
      </label>
     <label>
  Question:
  <textarea placeholder="Question" id="form-text"></textarea>
</label>
            
           <div class="button" id="send-question">Send Question</div>
            </div>
        
        
        </div>
        </div></div>
    
    
    
    
    </div>
    <div class="nav-bar">
        <div class="nav-bar-left">
            <a href="index.php"> <img src="Image/logoplaceholder.png"> </a>
        </div>
        <div class="nav-bar-right">
            <ul class="nav-bar-right-menu">
                <li> <a href="account.php" class="sliding-u-l-r">Account</a></li>
               
               
                <li class="nav-bar-button-outer"> <a href="logout.php" class="nav-bar-button">Log out</a></li>
            </ul>
        </div>
    </div>
    <div class="main-body-content" style="Display:inline-block;">
        
        <div class="sidebar">
            <?php
        if ((isset($_SESSION['status'])))
{     
            echo'<ul class="sidebar-menu" style="margin:0;">
                
            <a href="propertysearch.php">
                <li class="underline">Property Search</li>
            </a>
                
            <a href="shortlist.php">
                <li class="underline">Shortlist</li>
            </a>
            <a href="recommendations.php">
                <li class="underline">Recommendations</li></a>
                <a href="enquiry.php">
                <li class="underline">Property Enquiries</li></a>
                <a href="settings.php">
                <li class="underline">Settings</li></a><a href="logout.php">
                <li class="sidebar-menu-bottom underline" style=" border-top: 1px solid rgba(255,255,255,0.6); width:100%;">Log Out</li></a>
                </ul>';}?>
        </div>
        <div class="property-container">
        
        <div class="small-12 columns">
            <div class="property-advert-container">
            <div class="property-advert-topbar">
                <div class="property-advert-topbar-propertyname"><?php echo $row['address1'].', '. $row['address2'].'         <br>'. $row['address3'].', '.$row['postcode'] ;?></div>
                <div class="property-advert-topbar-right-section">
                    <ul>
                    <li class="right-section-price"><?php echo '£'.$row['pricePerMonth'].' pcm (£'.$weeklyprice.' pw)';?></li>
                    <li class="like-button" id="<?php echo $propertyid?>" style="display:block;">
                        <div class="center-thumbs">
                            <i class="fa fa-thumbs-up   liked" aria-hidden="true" ></i> Like</div></li>
                        
                    </ul>
                </div>
                </div>
                
                <div class="property-advert-bigimage-container">
                    
            <div class="property-advert-bigimage">
                 <?php
                        $counter = 0;
                      $images =mysqli_query($con,"SELECT * FROM advertpicture where advertpicture.advert_ID = $propertyid LIMIT 10");
                        $numberofrows =$images->num_rows;
          $imagearray = [];  
        if ($numberofrows <1){
            $src = "Image/noimage.jpg";
        }
        else{
            $counter = 0;
              while ($rowz = mysqli_fetch_assoc($images)){
                if ($counter == 0){
                    $src = str_replace('\\','/',$rowz['advertPictureUrl']);
                    $counter = 1;   
                  
                }
                    array_push($imagearray,str_replace('\\','/',$rowz['advertPictureUrl']));
                  
              }   
                
            }    
                
                
                ?>
                
                <img src="<?php echo $src?>" id="big-image"></div></div>
            <div class="property-advert-thumbnails">
                <ul>
               <?php foreach ($imagearray as $image){
                   
                    echo '<li><img src="'.$image.'"></li>';
                    
                }?>
                </ul>
                </div>
            <div class="property-advert-info-section">
                <div class="property-advert-description">
                    <div class="property-advert-description-text"><p><strong>Description</strong></p> <div class="property-advert-description-info"><strong>
                   <i class="fa fa-bed" aria-hidden="true"></i> <?php if($bedrooms>1){
                    
                    echo"$bedrooms"." bedrooms ";
                }
                else{
                    echo"$bedrooms"." bedroom ";
                }
                            
                      ?>
                            
                            <i class="fa fa-bath" aria-hidden="true"></i>
                            <?php      
                            if($bathroom>1){
                    
                    echo"$bathroom"." bathrooms";
                }
                else{
                    echo"$bathroom"." bathroom";
                }
        
                            
                            ?>
                        </strong>
                    </div><p><?php echo $description ?></p></div>
               
                </div>
                <div class="property-advert-features">
                    <p style="margin-top:15px; margin-left:15px;"><strong>Features</strong></p>
                <ul>
                    <div class="medium-12 large-6 columns">
                        <?php 
                        if ((int)$row['childFriendly'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Child friendly
                                </li>';
                            
                            
                        }
        
        else{
             echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                  
  
                                </span>
                                Child friendly
                                </li>';
            
        }
                        
                        ?>
                    </div>
                    <div class="medium-12 large-6 columns">
                    <?php   if ((int)$row['furnsihed'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Furnished
                                </li>';
                            
                            
                        }
        
        else{
             echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                   
  
                                </span>
                                Furnished
                                </li>';
                            
            
        }?>
                    </div>
                    <div class="medium-12 large-6 columns">
                    <?php if ((int)$row['garden'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Garden
                                </li>';
                            
                            
                        }
        else{
             echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                   
  
                                </span>
                                Garden
                                </li>';
            
        } ?>
                    </div>
                     <div class="medium-12 large-6 columns">
                    <?php if ((int)$row['disabled'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Disabled access
                                </li>';
                            
                            
                        }
        else{
            
            echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    
                                </span>
                                Disabled access
                                </li>';
            
        } ?>
                    </div>
                     <div class="medium-12 large-6 columns">
                    <?php  if ((int)$row['driveway'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Driveway
                                </li>';
                            
                            
                        }
        else{
            echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                  
                                </span>
                                Driveway
                                </li>';
                            
            
        } ?>
                    </div>
                     <div class="medium-12 large-6 columns">
                    <?php    if ((int)$row['smoker'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Smokers welcome
                                </li>';
                            
                            
                        }
        
        else{
            
             echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                   
  
                                </span>
                                Smokers welcome
                                </li>';
                            
        } ?>
                    </div>
                     <div class="medium-12 large-6 columns">
                    <?php if ((int)$row['pet'] == 1){
                           echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-check fa-stack-1x adjust-checkmark"></i> 
  
                                </span>
                                Pet friendly
                                </li>';
                            
                            
                        }
        else{
             echo' <li>
                                    <span class="fa-stack fa-1x">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                   
  
                                </span>
                                Pet friendly
                                </li>';
            
        } ?>
                    </div>
                    
                    <div class="medium-12 large-6 columns"> 
                        
                    </div>
                    </ul>
                
                </div>
                </div>
            </div>
            
            
            
            </div>
        
        
        
        </div><?php
         $landlord =mysqli_query($con,"SELECT * FROM landlord where User_ID =". $row['landlord_ID']);
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row2 = mysqli_fetch_assoc($landlord)){
           $agencyname = $row2['AgencyName'];
            $description = $row2['description'];
        $phoneno = $row2['PhoneNo'];
        $thumbnail = $row2['thumbnail'];
        }}
        
        $landlordRatingsResult = mysqli_query($con,"SELECT count(*) as'count', AVG(overallRating) as 'avg' FROM `landlordratings` where landlord_ID = $landlordRatings");
        
        while($row9 = mysqli_fetch_assoc($landlordRatingsResult)){
            
            
        ?>
        <div class="landlord-info-section">
            <p>Landlord Details</p>
            <p class="landlord-name"><?php echo $agencyname?></p>
            <?php echo $landlordlink?>
            <img class="landlord-thumbnail" src="<?php echo $thumbnail?>">
            <?php echo'</a>';?>
            <p class="landlord-phonenumber"> Telephone: <?php echo $phoneno?></p>
            <div class="landlord-ratings">
                 <div class="star-container ">
                  <?php 
              $stars = $row9['avg'];        
        for($i = 0; $i < 5;$i++){
            if ($stars >= 1){
                echo'  <div class="star"></div>';        
                $stars--;
            }
            elseif($stars >= 0.5 && $stars < 1){
                 echo'  <div class="half-star" style="    position: relative;"> <div class="empty-star" style="right: -6px;"></div></div>';
            }
            
            if ($stars == 0 && $i <= 5){
                 echo'   <div class="empty-star"></div>';
                
            }
            }?>
                </div><p>  <?php 
            echo $row9['count'].' ratings';
        
        ?></p></div>
            
            <p class="landlord-description">Description</p>
            <p class="landlord-description-text"><?php echo $description?></p>
            <div class="enquire-button">
                
                <p class="enquire-button-text" style="font-size:20px; margin:0;">Enquire</p>
            <i class="fa fa-envelope fa-2x" aria-hidden="true"></i></div>
        
        </div>
    <?php 
        }
        
        ?>
    
    </div>
</body>
    
    
    <?php
    }
                     ?>








<?php
                
                 
                 
                 }


?>









        <script type="text/javascript">
            
            
            $( document ).ready(function() {
                  $('.enquire-button').click(function(){
                 $('.form-container').css('display','block'); 
                          $('.main-body-content').css('overflow-y','hidden');
              });
              $('.fa-times-enquiry').click(function(){
                  
                 $('.form-container').css('display','none'); 
                   $('.main-body-content').css('overflow-y','auto');
              });
                $('#send-question').click(function(){
                  
                    
                     $.post("addquestion.php", {
                        landlordID:landlordID,propertyID:propertyID,Title: $('#form-title').val(),Text:$('#form-text').val()
                    },
                    function(data) {
                        

                    });
                  
                    
                });
                
                
                
   var height = $('.property-advert-container').height();
    $('.landlord-info-section').height(height);
});
$(window).on('resize', function(){
    
    var height = $('.property-advert-container').height();
    $('.landlord-info-section').height(height);
});

    $('.property-advert-thumbnails').on('click','img',function(){              
                var imgsrc=$(this).attr('src');             
            $("#big-image").attr("src",imgsrc);           
    
    });
      $('.like-button').click(function(){
          var thenum = $('.like-button').attr('id');
          alert (thenum);
           $.post("addtoshortlist.php", {
                        propertyid: thenum
                    },
                    function(data) {


                    });
           
      });

 function addToShortlist(element) {
                var thenum = (element.id).replace(/^\D+/g, '');
                alert(thenum);
                $.post("addtoshortlist.php", {
                        propertyid: thenum
                    },
                    function(data) {


                    });
              $('#'+element.id+'-text').text("Liked!");
                return false;

            }

            
        </script>
  
    
   





</html>

