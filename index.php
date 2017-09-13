<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    
    <script src="Jquery/jquery-2.2.4.js"></script>
    <script src="Jquery/typed.js"></script>
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
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/Image/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Rent ReQommender - Personalised property suggestions</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArnlZv6BzcaSytVDAu4ailJ2QkE1UPuJw&libraries=places&region=GB"></script>
    
    <script>
        
        
        var functionOne = $(function(){
      $(".element").typed({
        strings: ["Edinburgh^1000", "Glasgow^1000","Stirling^1000","Scotland"],
        cursorChar: "_",
        typeSpeed: 0
      });
        
        });

</script>
</head>

<body onload="focusSearchbar()">
    <div class="accountcreated" style="
    position: fixed;
    z-index: 100;
  margin-left:auto;
                                       margin-right:auto;
    text-align: center;
">
    
        <div class="small-2 columns small-centered account-creation-info">
        <p class="account-created-text">Account created</p>
        </div>
    </div>
    <div class="nav-bar">
        <div class="nav-bar-left">
            <a href="index.php"> <img src="Image/logoplaceholder.png"> </a>
        </div>
        <div class="nav-bar-right">
            <ul class="nav-bar-right-menu">
<?php
                if (isset($_SESSION['status']))
{
                echo' <li> <a href="account.php" class="sliding-u-l-r">Account</a></li>
                
                
                <li class="nav-bar-button-outer"> <a href="logout.php" class="nav-bar-button">Log out</a></li>';
}
                else{
                echo '<li> <a href="register.php" class="sliding-u-l-r">Register</a></li>
                <li class="nav-bar-button-outer"> <a href="login.php" class="nav-bar-button">Log in</a></li>'  ;
                }?>   
            </ul>
        </div>
    </div>
    <div class="main-body-outer">
        <div class="main-body-inner"></div>
        <div class="main-body-inner-text">
            <p class="no-margin">Find properties to rent in <span class="element"></span></p>
        </div>
        <form class="property-searchbar" action="propertysearch.php" method="get">
            <div class="row">
                <div class="medium-8 columns small-centered ">
                    <div class="input-group shadow input-group-round" id="search-box-glow"> <span class="input-group-label rounded-edge"><i class="fa fa-search" aria-hidden="true"></i></span>
                        <input class="input-group-field controls" type="text" placeholder="Edinburgh, EH14 or Heriot-Watt University " id="postcode" name="postcode">
                        <div class="input-group-field" style="width:150px;"><select style="margin:0; height:2.5rem;    font-size: 16px;
    font-weight: 400;" name="distance" id="distancechecker">
<option value="5">Within 5 miles</option>  
<option value="10">Within 10 miles</option>
  <option value="25">Within 25 miles</option>
  <option value="50">Within 50 miles</option>
  <option value="100">Within 100 miles</option>
<option value="10000">Nationwide</option>
</select></div>
                        <div class="input-group-button">
                            
                            <input type="submit" class="button round input-group-rounded" value="Search" id="submitButton" onclick="submittoSearch()">
                           
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="main-body-lower-content">
        <div class="row">
            <div class="medium-4 columns ">
                <p class="main-body-lower-content-header"> Property Reccomendations</p>
                <div class="row">
                    <div class="medium-4 columns"><i class="fa fa-home fa-icon-resize" aria-hidden="true"></i></div>
                    <div class="medium-8 columns">
                        <p class="main-body-lower-content-text">Based on the properties you've viewed and showed interest in, we find similar properties that may interest you!</p>
                    </div>
                </div>
            </div>
            <div class="medium-4 columns ">
                <p class="main-body-lower-content-header"> Property Shortlist</p>
                <div class="row">
                    <div class="medium-4 columns"><i class="fa fa-list-alt fa-icon-resize" aria-hidden="true"></i></div>
                    <div class="medium-8 columns">
                        <p class="main-body-lower-content-text">Found a property that you're interested in? Add it to your shortlist to keep up with any changes.</p>
                    </div>
                </div>
            </div>
            <div class="medium-4 columns ">
                <p class="main-body-lower-content-header"> Feedback System</p>
                <div class="row">
                    <div class="medium-4 columns"><i class="fa fa-comments fa-icon-resize" aria-hidden="true"></i></div>
                    <div class="medium-8 columns">
                        <p class="main-body-lower-content-text"> Do you think your landlord was great? Leave them feedback to show how good their services are! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function focusSearchbar() {
        document.getElementById("postcode").focus();
        checkaccountcreated();
    }
    function checkaccountcreated(){
        if (getQueryVariable("created")){
             $('.accountcreated').css('display','block');
            
        }
        
    }
    
      $('.accountcreated').click(function(){
            $('.accountcreated').css('display','none');
          
      });
    function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
    function submittoSearch(){
        
      
               

        
    }
   


    function init() {
        var input = document.getElementById('postcode');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', init);

</script>

</html>
