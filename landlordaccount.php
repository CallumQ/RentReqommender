<?php
session_start();
?>
<?php
 
if (!(isset($_SESSION['status'])))
{
     header("Location:login.php?login=1");  
}
else{
     if ($_SESSION["status"] != 2){
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
            <ul class="sidebar-menu" style="margin:0;">
                
            <a href="landlordaddproperty.php">
                <li class="underline">Add new property</li>
            </a>
                
            <a href="landlordproperties.php">
                <li class="underline">Manage properties</li>
            </a>
            <a href="enquiry.php">
                <li class="underline">Manage enquiries</li></a>
                                
                <a href="landlordsettings.php">
                <li class="underline">Settings</li></a><a href="logout.php">
                <li class="sidebar-menu-bottom underline" style=" border-top: 1px solid rgba(255,255,255,0.6); width:100%;">Log Out</li></a>
                </ul>
            </div>
        <div class="button-container">
        <div class="row">
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" id="propertycircle" onmouseout="dehighlight(this.id)">
                              <a href="landlordaddproperty.php">
                            <div class="circle-center">
                               <div class="circle-center-logo fa-icon-resize" style=" top: 6px;">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                     <i class="fa fa-plus absolute-icons" aria-hidden="true" style="
    text-shadow: 0px 0px 4px #000;
    left: 112px;
    font-size: 53px;
    top: 96px;
"></i>
                                </div>
                            </div>
                         </a>
                                  </div>
                           
                        <p class="settings-bubble-text"><a href="landlordaddproperty.php" id="search">Add property</a></p>
</div>
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="shortlistcircle">
                            <a href="landlordproperties.php">
                            <div class="circle-center">
                               <div class="circle-center-logo fa-icon-resize fa-large-list-resize" style="
    left: 40px;
    position: absolute;
    top: 14px;
">
                                   <i class="fa fa-home" aria-hidden="true"></i>
                                   <i class="fa fa-pencil absolute-icons" aria-hidden="true" style="
    text-shadow: 0px 0px 4px #000;
    font-size: 51px;
    top: 88px;
    left: 64px;
"></i>
                               
                                </div>
                            </div>
                                </a>
                        </div>
                        <p class="settings-bubble-text" id="shortlist"><a href="landlordproperties.php">Manage properties</a></p></div>
            <div class="large-4 columns"> <div class="circle" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="recommendationcircle">
                            <a href="enquiry.php">
                            <div class="circle-center">
                                <div class="circle-center-logo fa-icon-resize">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </div>
                            </div>
                                </a>
                        </div>
                        <p class="settings-bubble-text"><a href="enquiry.php" id="recommendations">Manage Enquiries</a></p>
</div>
            
            </div>
        <div class="row">
           
            <div class="large-12 columns"><div class="circle circle-lower" onmouseover="highlighttext(this.id)" onmouseout="dehighlight(this.id)" id="settingscircle">
                            
                             <a href="landlordsettings.php">
                            <div class="circle-center">
                            
                               
                                <div class="circle-center-logo fa-icon-resize" style="
    left: 35px;
    position: absolute;
    top: 14px;">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                </div>
                                    
                            </div></a>
                        </div>

                        <p class="settings-bubble-text"><a href="landlordsettings.php" id="account">Account Settings</a></p>
</div>

            
            </div>
        </div>

    </div>
    </body></html>