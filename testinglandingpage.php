<html>
<head> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     <link rel="stylesheet" href="css/foundation.css" />
     <link href="css/font-awesome.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/index.css">
    <style>
        
.testinglandingtext{
    background: white;
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.3);
    position: relative;
    top: 100px;
    margin-left: auto;
    margin-right: auto;
    width: 900px;


    text-align: center;
    transition: all 1s ease;
}
.testinglandingcontainer{
    position: relative;
    width: 900px;
   content: '';
  
      margin-left: auto;
    margin-right: auto;
        transition: all 1s ease;
}
.greybg{
    background: #e8e6e6;
    
}
.testdetails{
     background: white;
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.3);
    position: absolute;
    top: 100px;
    margin-left: auto;
    margin-right: auto;
    width: 900px;
 transition: all 1s ease;
left: 5000px;
    text-align: center;
   
    
}</style>
    </head>

    
    <body class="greybg">
    <div class="testinglandingcontainer">
    <div class="testinglandingtext">
        <img src="Image/HWLogo.jpg" width="300">
        <p style="padding-top:30px;">
            
            <strong>Testing the accuracy of a recommendation system.</strong><br><br>
        Thank you for taking part in this short study. This activity is completely voluntary and will not affect your performance grading at University in any way. In fact, no personal details will be taken and the study is completely anonymous. You have the right to withdraw at anytime without giving a reason. If you have any questions or problems please contact <a href="mailto:crq1@hw.ac.uk?Subject=Consent%20form" target="_top">crq1@hw.ac.uk</a> 
        <br><br>
       
If you agree with the above, are over 18 years old and are happy to continue please click the start button below.
</p>
        
        <form>
           
       
        <input type="submit" class="button" value="Start" id="buttonHold">
        
        
        </form>
        </div>
        <div class="testdetails">
        <img src="Image/HWLogo.jpg" width="300">
        <p style="padding-top:30px;">
            
            <strong>Test instructions</strong><br><br>Thank you for taking part in this study. Once you begin the study you will be assigned an example user. You will then be asked if you think that the property on the screen is suitable for that example user. This study is testing the accuracy of the system, so there are no right or wrong answers. Try to rate each property as if you were the persona that you have been assigned.<br><br>
            
            You will be shown 30 properties, and for each you will use the slider at the bottom of the screen to select how suitable you think that property is.
        <br><br>
            To begin click the start button below.
            </p>
        
        <form action="propertytesting.php" method="post">  <input type="submit" class="button" value="Start"></form>
            
        
        </div>
    </div>
    </body>
 <script>
     function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
     
     $( document ).ready(function() {
    $('#buttonHold').click(function(){
        
        var emailaddress = $('#email').val();
      
        if( isValidEmailAddress( emailaddress ) ) { /* do stuff here */ 
           alert("Invalid E-mail");
            $('#email').focus();
        
    
        }
        
        else{
            
             $('.testinglandingtext').animate({
        left: '-2000px'},20,'swing' 
         
         
     );
        
         $('.testdetails').animate({
        left: '0%'},20,'swing' 
         
         
     );
         
            
        }
         return false;
        });
         
        
     });
    </script>
</html>