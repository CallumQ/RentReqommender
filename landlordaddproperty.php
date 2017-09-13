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
     if ($_SESSION["status"] != 2){
             header("Location:landlordaccount.php");
     }
    
}


$select =mysqli_query($con,"SELECT * FROM `users` join landlord on users.User_ID = landlord.User_ID where users.User_ID = ". $_SESSION['accountID']);

                 $cRow = $select->num_rows;
                 if($cRow >= 1){
    while ($row = mysqli_fetch_assoc($select)){
     $contactName =  $row['ContactName'];
     $agencyName = $row['AgencyName'];
     $description = $row['description'];
    $phoneNo =  $row['PhoneNo'];
        if ($phoneNo == ''){
            $phoneNo = "No Phone number";
            
        }
    $Thumbnail = $row['thumbnail'];
        $email =$row['email'];
        
    
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
    
     <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAWu9ZhEzpYLrUPQUGFZ5ZFvKENLNOPu-g"></script>
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <style>
        .switch{
            color: black;
            
        }
        input:checked ~ .switch-paddle{
            color: white;
            
            
        }
        label{
            position: inherit;
            left: 16px;
            color: black;
            text-align: left;
            top: 10px;
            margin-bottom: 20px;
        }
        form div div{
            text-align: left;
        }
        .form-information{
            position: relative;
            
        }
        .error-message,.success-message{
            position: relative;
           
            margin-bottom: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            display: none;
        }
        
        .error-message{
             background: rgba(255,0,0,0.3);
            border: 3px solid red;
            
        }
        .success-message{
            
             background: rgba(0, 128, 0, 0.3);
            border: 3px solid green;
        }
        .form-background{
            position: relative;
            background: rgba(0,0,0,0.02);
            
            border: 1px solid #e7e7e7;
            border-radius: 10px;
            padding-bottom: 30px;
            margin-bottom:  20px;
        }
        .button-position, .button-cancel{
            border-radius: 0px 10px 0px 0px;
            position: absolute;
            top: 0;
            right: 0;
        }
        .button-cancel,.button-save{
            display: none;
            
        }
        .button-save{
            position: absolute;
            right: 0;
            bottom: 0;
            border-radius: 0px 0px 10px 0px;
            margin: 0;
            background: green;
            transition: all 0.4s ease;
        }
        .button-save:hover{
            background: #00BA25;
            
        }
        .red-button{
            background: #fd4141;
            
        }
        .red-button:hover{
            background: red;
            
        }
        
    </style>
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
        <div class="button-container" style="top:0; transform :translateY(-0%); margin-top:20px;">
            <p><strong>Add new property</strong></p>
            <div class=" row ">
            <div class="large-4  medium-6 small-6 columns small-centered error-message" id="error-section"></div>
                  </div>
            <div class="row">
                 <div class="large-4  medium-6 small-6 columns small-centered success-message" id="success-section"></div>
            </div>
          
            <div class="form-information ">
                
                
                
                
                <form action="process.php" method="post" enctype="multipart/form-data" id="upload_form">
                    
                    
                    
                    
                    
            <div class="row form-background">
            <label><strong>Property Information</strong> - General property information</label>
             
                <div class="large-3 columns ">
                    <label><strong>Address 1</strong><br>
                    <span id ="address1-s"><input type="text" id="address1" placeholder="Heriot-Watt University" name="address1"> </span></label></div>
                
                <div class="large-3 columns">
                     <label><strong>Address 2</strong><br>
                         <span id="address2-s"><input type="text" id="address2" placeholder="Ricarton" name="address2"></span></label></div>
               
               <div class="large-3 columns ">
                    <label><strong>Address 3</strong><br>
                    <span id ="address3-s"><input type="text" id="address3" placeholder="Edinburgh" name="address3"> </span></label></div>
                   <div class="large-3 columns ">
                    <label><strong>Postcode</strong><br>
                    <span id ="postcode1"><input type="text" id="postcode" placeholder="EH14 4AS" name="postcode"> </span></label></div>
                <div class="large-3 columns ">
                    <label><strong>Monthly rent</strong><br>
                    <span id ="rent1"><input type="number" id="rent" name="rent"> </span></label></div>
               <div class="large-3 columns ">
                    <label><strong>Number of bedrooms</strong><br>
                    <span id ="description"><select name="Rooms" id="RoomsSelect" required><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5+">5+</option></select> </span></label></div>
                <div class="large-3 columns ">
                    <label><strong>Number of bathrooms</strong><br>
                    <span id ="description"><select name="bathrooms" id="toiletSelect" required><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5+">5+</option></select> </span></label></div>
                  
                 <div class="large-3 columns ">
                    <label><strong>Property type</strong><br>
                    <span id ="description">         
         <select name="PropertyType" id="PropertyTypeSelect" required><option value="House">House</option><option value="Flat">Flat</option></select> </span></label></div>
                
                    <div class="large-12 columns ">
                    <label><strong>Description</strong><br>
                    <span id ="description">         
         <textarea name='desc' id='description-input' cols='40' rows='4' placeholder="General property description"></textarea> </span></label></div>
              
       
                </div>
                 
                    <div class="row form-background">
                         <label><strong>Property features</strong> - used for making property suggestions</label>
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
         <div class="medium-6 columns">
<div class="switch large">
    <p>Pet friendly</p>
  <input class="switch-input" id="pet" type="checkbox" name="pet">
  <label class="switch-paddle" for="pet">
   
    <span class="switch-active" aria-hidden="true">Yes</span>
    <span class="switch-inactive" aria-hidden="true">No</span>
  </label>
</div>
         </div>
                
                
                    
              
       
                </div>
                       <div class="row form-background">
                         <label><strong>Upload Images</strong> - Maximum of 5 pictures </label>
           <div class="medium-3 columns">
<input name="__files[]" type="file" multiple="multiple" id="inputfiles"/>
        
         </div>
         
                           
                           <div class="medium-12 columns" style="text-align:center">
                           <input type="submit" value="submit" name="__submit__" class="button" style="width:30%" id="submit-property">
                           </div>
        
                
                
                    
              
       
                </div>
                    
                   
                </form>
          
            
            
            </div>
        </div>
<?php }
                 }
?>
    </div>
    </body>
    
    
   
            
            
    <script type="text/javascript">
          var lng = "";
        var d1= $.Deferred();
    var lat = "";
        //configuration
var max_file_size           = 20485760; //allowed file size. (1 MB = 1048576)
var allowed_file_types      = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var result_output           = '#output'; //ID of an element for response output
var my_form_id              = '#upload_form'; //ID of an element for response output
var total_files_allowed     = 5; //Number files allowed to upload

//on form submit
        
        
        function getCoords(postcode){
            var geocoder= new google.maps.Geocoder();
    geocoder.geocode({
                    'address':  ($("#postcode").val())
                }, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                    lat = results[0].geometry.location.lat();
                    lng = results[0].geometry.location.lng();
                    flag = 1;
                            d1.resolve(); 
                    }
    })
            
            
   
        }
$(my_form_id).on( "submit", function(event) {
  
    
    
    var flag = 1;
    getCoords($("#postcode").val());
    event.preventDefault();
    var proceed = true; //set proceed flag
    var error = []; //errors
    var total_files_size = 0;
                $.when(d1).done(function(temp){
    $('#error-section').html('');
            $('#error-section').css('display','none');
            
            if (($('#address2').val() == '')||($('#address1').val() == '')||($('#address3').val() == '')||($('#postcode').val() == '')){
                $('#error-section').append('Invalid address');
                $('#error-section').css('display','block');   
            }
            else{
               if($('#rent').val() == ''){
                    $('#error-section').append('Invalid rent');
                    $('#error-section').css('display','block');   
                   
               }
                else{
                    var data = $('#formsubmit').serialize();
                   
                
                if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
        error.push("Your browser does not support new File API! Please upgrade."); //push error text
    }else{
        var total_selected_files = $('#inputfiles').get(0).files.length; //number of files
        
        //limit number of files allowed
        if(total_selected_files > total_files_allowed){
            error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
            proceed = false; //set proceed flag to false
        }
         //iterate files in file input field
        $($('#inputfiles').get(0).files).each(function(i, ifile){
            console.log("iterate");
            if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
                    error.push( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
                    proceed = false; //set proceed flag to false
                }

                total_files_size = total_files_size + ifile.size; //add file size to total size
            }
        });
        
        //if total file size is greater than max file size
        if(total_files_size > max_file_size){ 
            error.push( "You have "+total_selected_files+" file(s) with total size "+total_files_size+", Allowed size is " + max_file_size +", Try smaller file!"); //push error text
            proceed = false; //set proceed flag to false
        }
        
       
       
        //if everything looks good, proceed with jQuery Ajax
        if(proceed){
           //disable submit button
            var form11 = document.forms.namedItem("upload_form");
            var form_data = new FormData(form11);
            form_data.append("longitude",lng);
            form_data.append("latitude",lat);//Creates new FormData object
        
          for (var pair of form_data.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}              
            //jQuery Ajax to Post form data
            $.ajax({
                url : "process.php",
                type: "POST",
                data : form_data,
                contentType: false,
                cache: false,
                processData:false,
                mimeType:"multipart/form-data"
            }).done(function(res){ //
                window.location.href = 'landlordaccount.php?created=1';
               
            });
            return false;
        }
    }
                
                
                }
                
            }
    
    
    $(result_output).html(""); //reset output 
    $(error).each(function(i){ //output any error to output element
        $(result_output).append('<div class="error">'+error[i]+"</div>");
    });
        });
});
        
        $(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});
    </script>



</html>