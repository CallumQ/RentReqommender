<?php
session_start();
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
<link rel="stylesheet" href="css/rating.css"/>
    <script type="text/javascript" src="Jquery/rating.js"></script>
    <link rel="stylesheet" href="css/foundation.css" />
     <link href="css/font-awesome.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>Rent ReQommender - Personalised property suggestions</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
        <div class="medium-6 columns small-centered ">
           
                <div class="register-form">
                <fieldset class="large-6 columns small-centered">
    <legend style="text-align: center;"><p class="form-header-text">Account type</p> </legend>
                     <div class="row">
      
    
    <div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
                    </div>
  </fieldset>
  <div class="row" id="tenant-registerform">
     <form id="tenantform" name="tenantform">
      
      <div class="medium-6 columns">
      <label>Forename *
        <input type="text" placeholder="e.g. John" name="forename">
      </label>
    </div>
    <div class="medium-6 columns">
      <label>Surname *
        <input type="text" placeholder="e.g. Smith" name="surname">
      </label>
    </div>
      <div class="medium-6 columns">
      <label>E-mail Address *
        <input type="text" placeholder="e.g. johnsmith@example.com" name="email" id="email">
      </label>
    </div>
      <div class="medium-6 columns">
      <label>Confirm E-mail Address * 
        <input type="text" placeholder="Same E-mail Address as above" name="confirmemail" id="confirm-email">
      </label>
    </div>
        
         
         <div class="medium-6 columns">
      <label>Password *
        <input type="password" placeholder="e.g. ThisIsNotAGoodPassword123" name="password">
      </label>
    </div>
       <div class="medium-6 columns">
      <label>Confirm Password * 
        <input type="password" placeholder="e.g. ThisIsNotAGoodPassword123" name="passwordconfirm">
      </label>
    </div>
         <div class="medium-12 columns"><p class="centered">Preferences</p><p class="help-text centered">use the sliders below to toggle between which features are important for you in a property.</p></div>
         
         <div class="medium-12 columns" style="text-align:center;">
         <div class="medium-3 columns">
<div class="switch large">
    <p>Child friendly</p>
  <input class="switch-input" id="childfriendly" type="checkbox" name="childfriendly">
  <label class="switch-paddle" for="childfriendly">
    
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         
        <div class="medium-3 columns">
<div class="switch large">
    <p>Furnished</p>
  <input class="switch-input" id="Furnished" type="checkbox" name="furnished">
  <label class="switch-paddle" for="Furnished">
   
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         <div class="medium-3 columns">
<div class="switch large">
    <p>Garden</p>
  <input class="switch-input" id="Garden" type="checkbox" name="Garden">
  <label class="switch-paddle" for="Garden">
    
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         <div class="medium-3 columns">
<div class="switch large">
    <p>Disabled</p>
  <input class="switch-input" id="disabled" type="checkbox" name="disabled">
  <label class="switch-paddle" for="disabled">
    
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         <div class="medium-3 columns">
<div class="switch large">
    <p>Driveway</p>
  <input class="switch-input" id="driveway" type="checkbox" name="driveway">
  <label class="switch-paddle" for="driveway">
   
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
        <div class="medium-3 columns">
<div class="switch large">
    <p>Smoker friendly</p>
  <input class="switch-input" id="smoker" type="checkbox" name="smoker">
  <label class="switch-paddle" for="smoker">
   
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         <div class="medium-3 columns">
<div class="switch large">
    <p>Pet friendly</p>
  <input class="switch-input" id="pet" type="checkbox" name="pet">
  <label class="switch-paddle" for="pet">
   
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
         
         <div class="medium-3 columns">
         <label>Number of rooms <select name="rooms" style="margin-bottom:1px">
                        <option value="" disabled="" selected="">No of rooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                        </select></label>
         </div>
         
      <div class="medium-12 columns">
      
      <input type="submit" id="submit-tenant" class="button full-width-button" value="Submit" style="border: 1px solid rgba(255,255,255,0.5)"></div>
      
  </div>
</form></div>
                    
                    
                      <div class="row" id="LandLord-registerform">
     <form id="landlord-form">
      
      <div class="medium-6 columns">
      <label>Landlord name / letting agency name *
        <input type="text" placeholder="e.g. John" name="lettingagentname" id="landlordname">
      </label>
    </div>
    <div class="medium-6 columns">
      <label>Contact name *
        <input type="text" placeholder="e.g. Smith" name="contactname" id="landlord-contact-name">
      </label>
    </div>
      <div class="medium-6 columns">
      <label>E-mail Address *
        <input type="text" placeholder="e.g. johnsmith@example.com" name="email" id="landlord-email">
      </label>
    </div>
      <div class="medium-6 columns">
      <label>Confirm E-mail Address * 
        <input type="text" placeholder="Same E-mail Address as above" name="confirmemail" id="landlord-email-confirm">
      </label>
    </div>
      <div class="medium-6 columns">
      <label>Password *
        <input type="password" placeholder="e.g. ThisIsNotAGoodPassword123" name="password" id="landlord-password">
      </label>
    </div>
         <div class="medium-6 columns">
      <label> Confirm password *
        <input type="password" placeholder="e.g. ThisIsNotAGoodPassword123" name="confirmpassword" id="landlord-password-confirm">
      </label>
    </div>
       
      <div class="medium-12 columns">
      
      <input type="submit" class="button full-width-button" value="Submit" style="border: 1px solid rgba(255,255,255,0.5)" id="submit-landlord"></div>
      
  
</form>
                    </div>
            
            
          <p class="form-header-text footer-text"> 
            Already registered? Login <a href="login.php" class="login-link">Here</a></p> 
            </div>
        </div>
       
    </div>
</body>
<script type="text/javascript">

        $("#myonoffswitch").click(function(){
            if(document.getElementById('myonoffswitch').checked ){
            document.getElementById('tenant-registerform').style.display = 'block';
             document.getElementById('LandLord-registerform').style.display = 'none';
            
            }
            else{
                   document.getElementById('LandLord-registerform').style.display = 'block';
             document.getElementById('tenant-registerform').style.display = 'none';
                
            }
            
        });
       
        $('#submit-landlord').click(function(){
             if(($("#landlord-email").val() == $("#landlord-email-confirm").val()) && $("#landlord-email").val() != '' && $("#landlord-email-confirm").val() != '' ){
        var postdata = $("#landlord-form").serialize();
           
         $.post("landlordregister.php", postdata, function(data) {
           
      if(data == 'Success'){
           window.location.href = 'index.php?created=1';
          
      }
            
      }); 
        }
        else{
            alert("email's do not match or invalid email");
        }
        
        
        return false;
            
        });
    
    $("#submit-tenant").click(function(){
        
        if(($("#email").val() == $("#confirm-email").val()) && $("#email").val() != '' && $("#confirm-email").val() != '' ){
        var postdata = $("#tenantform").serialize();
           
         $.post("tenantregister.php", postdata, function(data) {
      if(data == 'Success'){
           window.location.href = 'index.php?created=1';
          
      }
            
      }); 
        }
        else{
              alert("email's do not match or invalid email");
        }
        
        
        return false;
    });
     
 
       
function yesnoCheck() {
    if (document.getElementById('AccountTenant').checked) {
       
    } else {
       
        
        
    }
    if(document.getElementById('AccountLandlord').checked){
            document.getElementById('').style.display = 'block';
            
            
        }
        else{
            document.getElementById('LandLord-registerform').style.display = 'none';
            
        }
}
        
      
       
</script>
</html>