<?php
session_start();
?>
<?php 
if (isset($_SESSION['status']))
{
     header("Location:account.php");  
}
else{

    
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

    <link rel="stylesheet" href="css/foundation.css" />
     <link href="css/font-awesome.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>Rent ReQommender - Personalised property suggestions</title>
    <script type="text/javascript">
        
      

        
      
       
</script>
</head>

<body>
   
         <div class="nav-bar">
        <div class="nav-bar-left">
            <a href="index.php"> <img src="Image/logoplaceholder.png"> </a>
        </div>
        <div class="nav-bar-right">
            <ul class="nav-bar-right-menu">
                <li> <a href="register.php" class="sliding-u-l-r">Register</a></li>
                <li class="nav-bar-button-outer"> <a href="login.php" class="nav-bar-button">Log in</a></li>
            </ul>
        </div>
    </div>
    
    <div class="main-body-content login-form">
        <div class="medium-8 large-5 columns small-centered ">
           
                <div class="register-form">
               <p class="form-header-text"> Login</p> 
                     <div class="row">
      
    
    
                    </div>
 
  <div class="row" id="">
     <form id="loginform" method="post" action="checkdetails.php">
         <?php if(isset($_GET["login"])):?>
          <div class="medium-6 columns small-centered">
              <div class="error">Please Login first</div></div>
    <?php endif; ?>
      <?php if(isset($_GET["error"])):?>
          <div class="medium-6 columns small-centered">
              <div class="error">Invalid Username or Password</div></div>
    <?php endif; ?>
      
      <div class="medium-6 columns small-centered">
      <label>E-mail Address *
        <input type="text" placeholder="e.g. johnsmith@example.com" name="email" id="email">
      </label>
    </div>
     
      <div class="medium-6 columns small-centered">
      <label>Password *
        <input type="password" placeholder="e.g. ThisIsNotAGoodPassword123" name="password" id="email">
      </label>
    </div>
       
      <div class="medium-6 columns small-centered" style="float:none;">
      
      <input type="submit" class="button full-width-button" value="Submit" style="border: 1px solid rgba(255,255,255,0.5)"></div>
      
  
</form></div>
                    
                    
                      
            
           <p class="form-header-text footer-text"> 
            Not registered? Register  <a href="register.php" class="login-link">Here</a></p> 
            </div>
        </div>
       
    </div>
</body>

</html>