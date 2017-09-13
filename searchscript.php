<?php
session_start();
?>         
                <?php
       include 'connection.php';         

                //calculating Geometry
                $distance  = intval($_GET['distance']);
                $NoOfItems = 10;
                $pageNo = $_GET['pageNo'];
                $radius = 3958.756;
                $lat = $_GET['Latitude'];
                $lng = $_GET['Longitude'];
                $maxlat = $lat + rad2deg($distance / $radius);
                $minlat = $lat - rad2deg($distance / $radius);
                $maxlng = $lng + rad2deg($distance / $radius / cos(deg2rad($lat)));
$minlng = $lng - rad2deg($distance / $radius / cos(deg2rad($lat)));




            $test = "AND";
            
               $string = "SELECT * FROM `advert` WHERE "; 
                $basestring = $string;
            if(isset($_GET['propertyType'])){
                if ($_GET['propertyType'] == "house"){
                    $string.= "propertyType = 'House' AND ";
                    
                }
                if ($_GET['propertyType'] == "flat"){
                    $string.= "propertyType = 'Flat' AND " ;
                    
                }
                
            }
            
            if (isset($_GET['rooms'])){
                if (is_numeric($_GET['rooms'])){
                $string.= "bedroom = ". intval($_GET['rooms'])." AND ";
                
                }
                else{
                    $string .= "bedroom >= 5 AND ";
                    
                }
            }
             if (isset($_GET['bathrooms'])){
                if (is_numeric($_GET['bathrooms'])){
                $string.= "bathrooms = ". intval($_GET['bathrooms'])." AND ";
                
                }
                else{
                    $string .= "bathrooms >= 5 AND ";
                    
                }
            }
            if (isset($_GET['Garden'])) {
                $string.= "garden = 1 AND ";
            }
             if (isset($_GET['Driveway'])) {
                $string.= "driveway = 1 AND ";
            }
 if (isset($_GET['Disabled'])) {
                $string.= "disabled = 1 AND ";
            }
 if (isset($_GET['Child'])) {
                $string.= "ChildFriendly = 1 AND ";
            }
 if (isset($_GET['Pet'])) {
                $string.= "pet = 1 AND ";
            }

if (isset($_GET['Smoker'])) {
                $string.= "smoker = 1 AND ";
            }
if (isset($_GET['Furnished'])) {
                $string.= "furnsihed = 1 AND ";
            }
 
$string.= "  (Latitude Between ". $minlat . " AND ". $maxlat .") AND (Longitude Between ". $minlng . " AND ". $maxlng.") AND ";

    if (strlen($string) == strlen($basestring)){
        
        $string = substr($string,0,-6);
    }
else{$string = substr($string,0,-4);}
            $getRows = mysqli_query($con,$string);
 $rowNo = $getRows ->num_rows;

                    if (isset($_GET['searchType'])){
                        if($_GET['searchType'] == 'Recent'){
                            $string.= " ORDER BY dateListed desc";
                            
                        }
                        elseif($_GET['searchType'] == 'Highest'){
                             $string.= " ORDER BY pricePerMonth DESC ";
                            
                        }
                        elseif($_GET['searchType'] == 'lowest'){
                             $string.= " ORDER BY pricePerMonth ASC ";
                            
                        }
                        
                    } 

                    $string.= " LIMIT ". $NoOfItems. " OFFSET " . $pageNo * $NoOfItems;

                    $select =mysqli_query($con,$string);
               
                 $cRow = $select->num_rows;
                
                 if($cRow >= 1){
        echo'<div class="header-content">
                <div class="pagination-container header-pagination">
            
            <i class="fa fa-arrow-left fa-2x pagination-left-arrow" aria-hidden="true" id="backwardButton"></i>
      <i class="fa fa-arrow-right fa-2x pagination-right-arrow" aria-hidden="true" id="forwardButton"></i>
            </div>
                <div class="header-content-pages">Showing page <span id="currentpage">'.($pageNo+1).'</span> of <span id="totalpage">'.ceil($rowNo / $NoOfItems).'</span></div>
                <div class="header-content-selection">  <form>
                Sort by
                <select name="preference" id="searchtype" onchange="searchfunction(this)">
                <option value="Recent">Most recent</option>
                <option value="Highest">Highest Price</option>
                <option value="lowest">Lowest Price</option>
               
                
                
                
                </select>
                
                </form></div>
                
                
                    
                    
                    
                    
                    
                  
              
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                ';?>

<?php
                     
    while ($row = mysqli_fetch_assoc($select)){
        $bathroom = $row['bathrooms'];   
        $landlordPicture = "";
        $hyperlink = '<a target="_blank" href="propertyview.php?advertID='.$row['advert_ID'].'" style=" color: black;">';
         $landlordlink = '<a target="_blank" href="landlordview.php?landlordID='.$row['landlord_ID'].'" style=" color: black;">';
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
                
        <div class="advert-standard">
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
    } echo'<div class="pagination-container bottom-padding">
            
            <i class="fa fa-arrow-left fa-4x pagination-left-arrow" aria-hidden="true" id="backwardButton1"></i>
      <i class="fa fa-arrow-right fa-4x pagination-right-arrow" aria-hidden="true" id="forwardButton1"></i>
            </div>'; }
      ?>


<script type="text/javascript">
       $("#forwardButton").click(function() {
        var max = parseInt(document.getElementById("totalpage").textContent);
           if(pagenum !=max-1){
    
               pagenum = pagenum +1;
                       QueryDatabase();
           }
    
            });
           $("#forwardButton1").click(function() {
        var max = parseInt(document.getElementById("totalpage").textContent);
           if(pagenum !=max-1){
    
               pagenum = pagenum +1;
                       QueryDatabase();
           }
    
            });
            
            $("#backwardButton").click(function() {
                if (pagenum >=1){ 
                 pagenum = pagenum -1;
              
                QueryDatabase();
            }});
    
      $("#backwardButton1").click(function() {
                if (pagenum >=1){ 
                 pagenum = pagenum -1;
              
                QueryDatabase();
            }});
           </script>