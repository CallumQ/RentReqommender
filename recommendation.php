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
<?php 
$command = "  python /home/example3/www/Dissertation/tester.py";
$startENV = "source ~/bin/testnv/bin/activate";
$deactivate = "deactivate";


$output = shell_exec($command);
echo $output;

$incommand = " ";
for($i = 0; $i < sizeof($response); $i++){
   
    $incommand .= $response[$i] . ",";
    
}
$incommand = substr($incommand,0,-1);
echo $response;
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
   $(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});
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
                    , shrinkOn = 150;
                if ($(window).width() < 1024 & $(window).width() > 640) {
                    if (distanceY > shrinkOn) {
                        document.getElementById("header-logo").width = "0";
                    }
                    else {
                        document.getElementById("header-logo").width = "100";
                    }
                }
                else {
                    document.getElementById("header-logo").width = "100";
                }
            });
        });
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
<?php
exec($deactivate);
?>