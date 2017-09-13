<?php
session_start();
?>
<?php
include 'connection.php';

?>
    <!doctype html>
    <html lang="en">

    <head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
        <script type="text/javascript">
          var pagenum = 0;
            var searchmethod;


           
            
           
            function QueryDatabase() {
                if(searchmethod == null){
                    
                    searchmethod = "Recent";
                }
              var distance = $('#distancechecker').val();
                var pageNo = "&pageNo="+pagenum;
                if (distance != null){
                    
                    if ($('#postcode').val() != ''){
                            var geocoder = new google.maps.Geocoder();
                var address = postcode;
                var coords = "";
                geocoder.geocode({
                    'address':  ($("#postcode").val())
                }, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        
                        coords = "&Latitude=" + results[0].geometry.location.lat() + "&Longitude=" + results[0].geometry.location.lng();
                    

                
             


                data = $('form').serialize();
             data += coords;
                        data+= pageNo;
                        data += "&searchType="+ searchmethod;
                      
                console.log(data)
//
               $('.modal').css("display", "block");
              $('.advert-container1').addClass("loading");
//

             $.get("searchscript.php", data, function(data) {
                    $(".advert-container1").html(' ');
                 $(".advert-container1").append(data);
                $('.modal').css("display", "none");
                  $('.advert-container1').removeClass("loading");
                    $('#searchtype').val(searchmethod);
            });
                
                return false;
                        
                    }



            }
                                 )
                        
                        
                    }
                    
                    else{
                        
                       document.getElementById("postcode").focus();
                    }
                    
                }
                
            }
        </script>
    </head>

    <body>

        <div class="nav-bar">
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


                    <li class="underline">Property Search
                        <ul style="    margin-left: 15px;">
                            <form>
                                <li><select name="distance" id="distancechecker" style="margin-bottom:1px" required>
                        <option value="" disabled="" selected="" >Distance</option>
                        <option value="5">Within 5 miles</option>
                        <option value="10">Within 10 miles</option>
                        <option value="25">Within 25 miles</option>
                        <option value="50">Within 50 miles</option>
                        <option value="100">Within 100 miles</option>
                        <option value="10000">Nationwide</option>
                        
                        
                        
                        
                        </select></li>
                                <li><input type="text" id="postcode" name="postcode" placeholder="Postcode" style="margin-bottom:5px" required></li>
                                <li><select name="propertyType" style="margin-bottom:0px">
                            <option value="" disabled="" selected=""> Property type</option>
                            <option value="house">House</option>
                            <option value="flat">Flat</option>
                            </select></li>
                                <li><select name="rooms" style="margin-bottom:1px">
                        <option value="" disabled="" selected="">Number of bedrooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="more">5+</option>
                        </select></li>
                                <li><select name="bathrooms" style="margin-bottom:1px">
                        <option value="" disabled="" selected="">Number of bathrooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="more">5+</option>
                        </select></li>
                                <li>
                                    <label>Garden
                                <input type="checkbox" name="Garden" value="garden" ></label>
                                </li>
                                <li>
                                    <label>Driveway
                                <input type="checkbox" name="Driveway" value="driveway" ></label>
                                </li>
                                <li>
                                    <label style="
">Disabled Access
                                <input type="checkbox" name="Disabled" value="disabled" ></label>
                                </li>
                                <li>
                                    <label>Child friendly
                                <input type="checkbox" name="Child" value="child" style="
    margin-left: 79px;
"></label>
                                </li>
                                <li>
                                    <label>Pet friendly
                                <input type="checkbox" name="Pet" value="pet" ></label>
                                </li>
                                <li>
                                    <label>Smoker friendly
                                <input type="checkbox" name="Smoker" value="smoker" ></label>
                                </li>
                                <li>
                                    <label>Furnished
                                <input type="checkbox" name="Furnished" value="furnished" ></label>
                                </li>

                                <li><input type="button" value="Search" id="submitButton" style="
    color: black;
    font-size: 17px;
                                    width: 100%; padding:0; padding-top:10px; padding-bottom:10px;
" class="btn-style"></li>
                            </form>
                        </ul>

                    </li>

                    <a href="shortlist.php">
                        <li class="underline">Shortlist</li>
                    </a>
                    <a href="recommendation.php">
                        <li class="underline">Recommendations</li>
                    </a>
                    <a href="userenquiry.php">
                        <li class="underline">Property Enquiries</li>
                    </a>
                    <a href="settings.php">
                        <li class="underline">Settings</li>
                    </a>
                    <a href="logout.php">
                        <li class="sidebar-menu-bottom underline" style=" border-top: 1px solid rgba(255,255,255,0.6);     width: 100%;
    left: 0;">Log Out</li>
                    </a>
                </ul>
            </div>

            <div class="advert-container1">

                





  



            </div>
            
          
            <div class="modal"></div>
        </div>
    </body>
        <?php 
        if (isset($_GET['postcode'])){ 
            if (isset($_GET['distance'])){
                $distance = $_GET['distance'];
                $postcode = $_GET['postcode'];
            echo'<script type="text/javascript"> $("#distancechecker").val('.$distance.');
            $("#postcode").val("'.$postcode.'");
            QueryDatabase();
            </script>';    
                
            }
            
            
        }?>
   <script type="text/javascript">
       
       var $logo = $('#sidebar');
$(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});
       
        function addToShortlist(element) {
                var thenum = (element.id).replace(/^\D+/g, '');

                $.post("addtoshortlist.php", {
                        propertyid: thenum
                    },
                    function(data) {


                    });
              $('#'+element.id+'-text').text("Liked!");
                return false;

            }
  
       
    function searchfunction(item){
         pagenum = 0;
              searchmethod = $('#searchtype').val()
              
                QueryDatabase();
       
    }
       
       $("#submitButton").click(function() {
                 pagenum = 0;
              
                QueryDatabase();
            });</script>
    </html>
