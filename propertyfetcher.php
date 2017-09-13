<?php
session_start();
?>
<?php
include 'connection.php';
$propertyid = $_POST['propertyID'];



 $select =mysqli_query($con,"SELECT * FROM advert where advert.advert_ID = $propertyid LIMIT 20");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
           $price = $row['pricePerMonth'];
            $weeklyprice =round($price *12 / 52);
            $bedrooms = $row['bedroom'];
            $description = $row['description'];
            $noOfPics;
       $bathroom = $row['bathrooms'];   
        
        
        $picturecount = mysqli_query($con,"SELECT COUNT(advertpicture.advert_ID) totalcount FROM advertpicture WHERE advertpicture.advert_ID =".$row['advert_ID']);    
        while($row2 = mysqli_fetch_assoc($picturecount)){
            $noOfPics = $row2['totalcount'];
        }
    ?>    
<div class="property-container">
        
        <div class="small-12 columns">
            <div class="property-advert-container">
            <div class="property-advert-topbar">
                <div class="property-advert-topbar-propertyname"><?php echo '£'.$row['pricePerMonth'].' pcm (£'.$weeklyprice.' pw)';?></div>
                <div class="property-advert-topbar-right-section">
                    <ul>
                    <li class="right-section-price"> </li>
                    
                        
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
        
        
        
        </div>
    <?php }}?>
<script>

 $('.property-advert-thumbnails').on('click','img',function(){              
                var imgsrc=$(this).attr('src');             
            $("#big-image").attr("src",imgsrc);           
    
    });
</script>