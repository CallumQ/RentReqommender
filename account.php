<?php
session_start();
?>
<?php
 
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
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Rent ReQommender - Personalised property suggestions</title>
    <script type="text/javascript">
         function dehighlight(hello){
            document.getElementById(hello).nextSibling.nextElementSibling.childNodes[0].style.color = "black"; 
        }
        
        
        function highlighttext(hello){
            document.getElementById(hello).nextSibling.nextElementSibling.childNodes[0].style.color = "#0C7C99"; 
        }
        
        
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

    </script>
    <style>
        @media screen and (max-width: 1024px) {
            .button-container{
                margin-top: 340px;
                
            }
            
        }
    
    </style>
</head>

<body>

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
        <div class="button-container" >
        <div class="row">
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" id="propertycircle" onmouseout="dehighlight(this.id)">
                              <a href="propertysearch.php">
                            <div class="circle-center">
                                <div class="circle-center-logo fa-icon-resize" style=" top: 6px;">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                         </a>
                                  </div>
                           
                        <p class="settings-bubble-text"><a href="propertysearch.php" id="search">Property Search</a></p>
</div>
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="shortlistcircle">
                            <a href="shortlist.php">
                            <div class="circle-center">
                               <div class="circle-center-logo fa-icon-resize fa-large-list-resize" style="
    left: 40px;
    position: absolute;
    top: 14px;
">
                                    <i class="fa fa-list-alt " aria-hidden="true"></i>
                               
                                </div>
                            </div>
                                </a>
                        </div>
                        <p class="settings-bubble-text" id="shortlist"><a href="shortlist.php">Shortlist</a></p></div>
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="recommendationcircle">
                            <a href="recommendations.php">
                            <div class="circle-center">
                                <div class="circle-center-logo fa-icon-resize">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                </div>
                            </div>
                                </a>
                        </div>
                        <p class="settings-bubble-text"><a href="recommendations.php" id="recommendations">My Recommendations</a></p>
</div>
            
            </div>
        <div class="row">
            <div class="large-6 columns"><div class="circle circle-lower " onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="enquirycircle">


                          
                               <a href="userenquiry.php"> <div class="circle-center">
                                    <div class="circle-center-logo fa-icon-resize"style="
    left: 46px;
    position: absolute;
    top: 14px;
">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </div>
                                </div>
</a>
                        </div>
                        <p class="settings-bubble-text"><a href="userenquiry.php" id="enquiry">Manage Enquiries</a></p>  
                    </div>
            <div class="large-6 columns"><div class="circle circle-lower" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="settingscircle">
                            
                             <a href="settings.php">
                            <div class="circle-center">
                            
                               
                                <div class="circle-center-logo fa-icon-resize" style="
    left: 35px;
    position: absolute;
    top: 14px;">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                </div>
                                    
                            </div></a>
                        </div>

                        <p class="settings-bubble-text"><a href="settings.php" id="account">Account Settings</a></p>
</div>

            
            </div>
        </div>

    </div>
    </body>

    
    

</html>