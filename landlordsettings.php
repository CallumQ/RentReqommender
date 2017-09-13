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
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index.css">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <style>
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
            <p><strong>Account Information</strong></p>
            <div class=" row ">
            <div class="large-4  medium-6 small-6 columns small-centered error-message" id="error-section"></div>
                  </div>
            <div class="row">
                 <div class="large-4  medium-6 small-6 columns small-centered success-message" id="success-section"></div>
            </div>
          
            <div class="form-information ">
                <form>
            <div class="row form-background">
            <label><strong>Personal details</strong> - General user information</label>
            <div class="button button-position" id="edit-personal">Edit</div>
            <div class="button button-cancel red-button" id ="cancel-personal">Cancel</div>
            <div class="button button-save" id ="save-personal">Save</div>    
                <div class="large-3 columns ">
                    <label><strong>Agency Name</strong><br>
                    <span id ="forename"><?php echo $agencyName; ?> </span></label></div>
                
                <div class="large-3 columns">
                     <label><strong>Contact Name</strong><br>
                         <span id="surname"><?php echo $contactName; ?></span></label></div>
               
               <div class="large-3 columns ">
                    <label><strong>E-mail Address</strong><br>
                    <span id ="email"><?php echo $email?> </span></label></div>
                   <div class="large-3 columns ">
                    <label><strong>Telephone Number</strong><br>
                    <span id ="phoneno"><?php echo $phoneNo?> </span></label></div>
               <div class="large-12 columns ">
                    <label><strong>Description</strong><br>
                    <span id ="description"><?php echo $description?> </span></label></div>
                  
         
                </div>
                 
                    
                    
                <div class="row form-background">
            <label style="margin-bottom:16px;"><strong>Password </strong>- Update your password</label>
                      <div class="button button-cancel red-button" id ="cancel-password">Cancel</div>
            <div class="button button-position" id="change-password" style="border-radius: 0px 10px 0px 0px;">Change password</div>
                    <div class="button button-save" id ="save-password">Update password</div>  
                    <div id="password-section">
                 
                    </div>
                   </div>
                    
                     <div class="row form-background">
            <label style="margin-bottom:16px;"><strong>Delete Account </strong>- Delete all of your information, including shortlisted properties</label>
                          <div class="button button-cancel red-button" id ="cancel-account">Cancel</div>
            <div class="button button-position red-button" style="border-radius: 0px 10px 0px 0px;" id="delete-account">Delete Account</div>
                   <div class="button button-save" id ="save-account" style="background:red;">Delete Account</div>
                   <div id="delete-account-section"></div>
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
        var forenameHTML = "";
        var surnameHTML = "";
        var emailHTML= "";
        var descriptionHTML ="";
        var phonenoHTML ="";
        
        var tempdescription ="";
        var tempphoneno ="";
        var tempFore ="";
        var tempSur =  "";
        var tempEmail=""; 
        
        
     $("#edit-personal").click(function() {
          $('#success-section').html('');
         $("#success-section").css("display","none");
                $("#edit-personal").css("display","none");
         $("#cancel-personal").css("display","block");
 $("#save-personal").css("display","block");
         descriptionHTML = $('#description').get(0).outerHTML;        
         phonenoHTML =  $('#phoneno').get(0).outerHTML;
         forenameHTML = $('#forename').get(0).outerHTML;
         surnameHTML = $('#surname').get(0).outerHTML;
         emailHTML = $('#email').get(0).outerHTML;
         
         tempdescription = $('#description').html();
         tempphoneno = $('#phoneno').html();
         tempFore = $("#forename").html();
          tempSur =  $("#surname").html();
          tempEmail = $("#email").html();
         
         $('#description').html('');
         $('#phoneno').html('');
         $("#forename").html('');
         $("#surname").html('');
         $("#email").html('');
         
          $('#description').append("<textarea name='Text1' id='description-input' cols='40' rows='5'>"+ tempdescription + "</textarea>");
         $('#phoneno').append("<input type='text' id='phoneno-input' value='"+ tempphoneno +"'>");
         $("#forename").append("<input type='text' id='forename-input' value='"+ tempFore +"'>");
         $("#surname").append("<input type='text' id='surname-input' value='"+ tempSur +"'>");
         $("#email").append("<input type='text' id='email-input' value='"+ tempEmail +"'>");
      
         

            });
    $("#cancel-personal").click(function() {
        $('#success-section').html('');
         $("#success-section").css("display","none");
        $('#error-section').css('display','none'); 
        $("#cancel-personal").css("display","none");
         $("#save-personal").css("display","none");
         $("#edit-personal").css("display","block");
       
        
         $('#description').html('');
         $('#phoneno').html('');
         $("#forename").html('');
         $("#surname").html('');
         $("#email").html('');
         $('#image-insert').html('');
         $('#description').append(tempdescription);
         $('#phoneno').append(tempphoneno);
        $("#forename").append(tempFore);
        $("#surname").append(tempSur);
        $("#email").append(tempEmail);
    });
        //configuration
var max_file_size           = 2048576; //allowed file size. (1 MB = 1048576)
var allowed_file_types      = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var result_output           = '#output'; //ID of an element for response output
var my_form_id              = '#upload_form'; //ID of an element for response output
var total_files_allowed     = 3; //Number files allowed to upload

//on form submit
$(my_form_id).on( "submit", function(event) { 
    event.preventDefault();
    var proceed = true; //set proceed flag
    var error = []; //errors
    var total_files_size = 0;
    
    if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
        error.push("Your browser does not support new File API! Please upgrade."); //push error text
    }else{
        var total_selected_files = this.elements['__files[]'].files.length; //number of files
        
        //limit number of files allowed
        if(total_selected_files > total_files_allowed){
            error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
            proceed = false; //set proceed flag to false
        }
         //iterate files in file input field
        $(this.elements['__files[]'].files).each(function(i, ifile){
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
        
        var submit_btn  = $(this).find("input[type=submit]"); //form submit button  
        
        //if everything looks good, proceed with jQuery Ajax
        if(proceed){
            submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
            var form_data = new FormData(this); //Creates new FormData object
            var post_url = $(this).attr("action"); //get action URL of form
            
            //jQuery Ajax to Post form data
            $.ajax({
                url : post_url,
                type: "POST",
                data : form_data,
                contentType: false,
                cache: false,
                processData:false,
                mimeType:"multipart/form-data"
            }).done(function(res){ //
                $(my_form_id)[0].reset(); //reset form
                $(result_output).html(res); //output response from server
                submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
            });
        }
    }
    
    $(result_output).html(""); //reset output 
    $(error).each(function(i){ //output any error to output element
        $(result_output).append('<div class="error">'+error[i]+"</div>");
    });
        
});
         $("#save-personal").click(function() {
           $('#error-section').html('');
                        
                        
        var description = $.trim($('#description-input').val());     
        var phoneno = $.trim($('#phoneno-input').val());     
        var imagepath = $.trim($('#fileToUpload').val());     
        var submitforename =   $.trim($("#forename-input").val());
        var submitsurname = $.trim($("#surname-input").val());
        var submitemail =      $.trim($("#email-input").val());
             
             
             
             
             
             
             
             
              $.post("updatelandlord.php", {Forename:submitforename,Surname:submitsurname,email:submitemail,filepath: imagepath, description:description,phoneno:phoneno}, function(data) {
                  alert(data);
                     data = $.trim(data);
                  if (data == 'emailExists'){
                   $('#error-section').append('E-mail already exists.');
                    $('#error-section').css('display','block');
                      $('#email-input').css('border-color','red'); 
                      $('#email-input').focus();
                     
                  } 
                  else if(data =='UpdateSuccess'){
                        $('#success-section').append('Information updated.');
                       $("#success-section").css("display","block");
                      $('#email-input').css('border-color','rgb(202, 202, 202)');
                         $('#error-section').css('display','none'); 
        $("#cancel-personal").css("display","none");
         $("#save-personal").css("display","none");
         $("#edit-personal").css("display","block");
                      
                       $("#forename").html('');
         $("#surname").html('');
         $("#email").html('');
         
                       $("#forename").append(submitforename);
        $("#surname").append(submitsurname);
        $("#email").append(submitemail);
                      
                      
                      
                  }
                  
            });
                
                return false; 
             
        
    });
           
        $("#edit-prefer").click(function() {
             $('#success-section').html('');
         $("#success-section").css("display","none");
           $("#edit-prefer").css("display","none");
         $("#cancel-prefer").css("display","block");
         $("#save-prefer").css("display","block");
              
          childHTML= $("#Child").get(0).outerHTML;
           furnishedHTML =   $("#Furnished").get(0).outerHTML;
           gardenHTML =  $("#Garden").get(0).outerHTML;
             disabledHTML =   $("#Disabled").get(0).outerHTML;
            drivewayHTML =  $("#Driveway").get(0).outerHTML;
          smokerHTML =  $("#Smoker").get(0).outerHTML;
            petHTML = $("#Pet").get(0).outerHTML;
            roomsHTML =  $("#Rooms").get(0).outerHTML;
             propertytypeHTML = $("#PropertyType").get(0).outerHTML;
            
            tempChild =  $.trim($("#Child").html());
            tempFurnished =  $.trim($("#Furnished").html());
            tempGarden =  $.trim($("#Garden").html());
            tempDisabled = $.trim($("#Disabled").html());
            tempDriveway = $.trim($("#Driveway").html());
            tempSmoker = $.trim($("#Smoker").html());
            tempPet = $.trim($("#Pet").html());
            tempRooms = $.trim($("#Rooms").html());
            tempPropertyType = $.trim($("#PropertyType").html());
  
            $("#Child").html('');
            $("#Furnished").html('');
             $("#Garden").html('');
             $("#Disabled").html('');
             $("#Driveway").html('');
             $("#Smoker").html('');
             $("#Pet").html('');
             $("#Rooms").html('');
             $("#PropertyType").html('');
       
            
            
            $("#Child").append('<select name="Child" id="ChildSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Furnished").append('<select name="Furnished" id="FurnishedSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Garden").append('<select name="Garden" id="GardenSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Disabled").append('<select name="Disabled" id="DisabledSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Driveway").append('<select name="Driveway" id="DrivewaySelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Smoker").append('<select name="Smoker" id="SmokerSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Pet").append('<select name="Pet" id="PetSelect" required><option value="Yes">Yes</option><option value="No">No</option></select>');
            $("#Rooms").append('<select name="Rooms" id="RoomsSelect" required><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5+">5+</option></select>');
             $("#PropertyType").append('<select name="PropertyType" id="PropertyTypeSelect" required><option value="House">House</option><option value="Flat">Flat</option></select>');

            $("#ChildSelect").val(tempChild);
            $("#FurnishedSelect").val(tempFurnished);
            $("#GardenSelect").val(tempGarden);
            $("#DisabledSelect").val(tempDisabled);
            $("#DrivewaySelect").val(tempDriveway);
            $("#SmokerSelect").val(tempSmoker);
            $("#PetSelect").val(tempPet);
            if(tempRooms == 5){$("#RoomsSelect").val(tempRooms+"+");
                             }
            else
                {$("#RoomsSelect").val(tempRooms);}
                $("#PropertyTypeSelect").val(tempPropertyType);
        
       
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            });
    $("#cancel-prefer").click(function() {
        $("#cancel-prefer").css("display","none");
        $("#save-prefer").css("display","none");
        $("#edit-prefer").css("display","block");
        
        $("#Child").html('');
        $("#Furnished").html('');
        $("#Garden").html('');
        $("#Disabled").html('');
        $("#Driveway").html('');
        $("#Smoker").html('');
        $("#Pet").html('');
        $("#Rooms").html('');
        $("#PropertyType").html('');
       
        $("#Child").append(tempChild);
        $("#Furnished").append(tempFurnished);
        $("#Garden").append(tempGarden);
        $("#Disabled").append(tempDisabled);
        $("#Driveway").append(tempDriveway);
        $("#Smoker").append(tempSmoker);
        $("#Pet").append(tempPet);
        $("#Rooms").append(tempRooms);
        $("#PropertyType").append(tempPropertyType);
        
        
    });
        $('#cancel-password').click(function(){
            $('#password-section').html('');
            $("#save-password").css("display","none");
            $("#cancel-password").css("display","none");
             $("#change-password").css("display","block");
              $('#error-section').css('display','none'); 
        });
        $('#change-password').click(function(){
             $('#success-section').html('');
         $("#success-section").css("display","none");
            $("#cancel-password").css("display","block");
             $("#change-password").css("display","none");
            $("#save-password").css("display","block");
            $('#password-section').append('<div class="large-4 columns"><label><strong>Current password </strong><br><span id ="current-password"><input type="password" autocomplete="false" id="current-password-input">  </span></label></div><div class="large-4 columns"><label><strong>New password </strong><br><span id ="new-password"><input type="password" autocomplete="false" id="new-password-input">  </span></label></div><div class="large-4 columns"><label><strong>Confirm Password </strong><br><span id ="confirm-password"><input type="password" autocomplete="false" id="confirm-password-input">  </span></label></div>');
            
            
        });
        
        $('#save-password').click(function(){
             $('#error-section').html('');
            var currentpassword = $('#current-password-input').val();
            var newpassword = $('#new-password-input').val();
            var confirmpassword = $('#confirm-password-input').val();
            if (currentpassword ==''){
                   $('#current-password-input').css('border-color','red');
                     $('#error-section').append('Invalid password.');
                     $('#error-section').css('display','block'); 
                
            }else{
            if(newpassword != confirmpassword){
                $('#error-section').append('Passwords do not match.');
                 $('#new-password-input').css('border-color','red');
                 $('#confirm-password-input').css('border-color','red');
                    $('#error-section').css('display','block'); 
            }
            else{
                
                    if (newpassword ==''){
                        $('#error-section').append('Please enter a valid password.');
                 $('#new-password-input').css('border-color','red');
                 $('#confirm-password-input').css('border-color','red');
                    $('#error-section').css('display','block'); 
                        
                    }
                else{
                  $('#new-password-input').css('border-color','rgb(202, 202, 202)');
                 $('#confirm-password-input').css('border-color','rgb(202, 202, 202)');
                $.post("checkpassword.php", {currentpassword: currentpassword}, function(data) {
                   
                if(data == 'Match'){
                     $('#error-section').html('');
                    $('#current-password-input').css('border-color','rgb(202, 202, 202)');
                        $('#error-section').css('display','none'); 
                    
                    $.post("updatepassword.php", {newpassword: newpassword}, function(data) {
                       
                    if (data == 'UpdateSuccess'){
                        $('#success-section').append('password updated.');
                       $("#success-section").css("display","block");
                        $('#password-section').html('');
                        $("#save-password").css("display","none");
            $("#cancel-password").css("display","none");
             $("#change-password").css("display","block");
                    }
                    });
                }
                else{
                     $('#current-password-input').css('border-color','red');
                     $('#error-section').append('Invalid password.');
                     $('#error-section').css('display','block'); 
                    
                }
            });
                
                }
            }
            }
        });
        $('#delete-account').click(function(){
              $("#delete-account").css("display","none");
         $("#cancel-account").css("display","block");
         $("#save-account").css("display","block");
            $("#delete-account-section").append(' <div class="small-6 columns"><label><strong>Password</strong><input type="password" id="account-initial"></label></div><div class="small-6 columns"><label><strong>Confirm password</strong><input type="password" id="account-confirmed"></label></div>');
            
        });
        
        $("#cancel-account").click(function(){
             $("#delete-account").css("display","block");
             $("#cancel-account").css("display","none");
         $("#save-account").css("display","none");
            $("#delete-account-section").html('');
            
        });
        $("#save-account").click(function(){
             $('#error-section').html('');
             $('#error-section').css('display','none');
            var password = $("#account-initial").val();
            var currentpassword = $("#account-confirmed").val();
            if (currentpassword != password){
                 $('#account-initial').css('border-color','red');
                 $('#account-confirmed').css('border-color','red');
                    $('#error-section').css('display','block');
                $('#error-section').append("Passwords do not match.");
                
            }
            else{
                
                 $('#account-initial'). css('border-color','rgb(202, 202, 202)');
                 $('#account-confirmed'). css('border-color','rgb(202, 202, 202)');
             $.post("checkpassword.php", {currentpassword: currentpassword}, function(data) {
                   
                if(data == 'Match'){
                      $('#error-section').html('');
                    $('#account-initial').css('border-color','rgb(202, 202, 202)');
                      $('#account-confirmed').css('border-color','rgb(202, 202, 202)');
                        $('#error-section').css('display','none'); 
                    $.post("deleteaccount.php", {currentpassword: currentpassword}, function(data) {
                        if(data =='Success'){
                 
                            window.location.href = 'logout.php';
                        }
                        
                    });
             
                }
                 
                 else{
                     $('#current-password-input').css('border-color','red');
                     $('#error-section').append('Invalid password.');
                     $('#error-section').css('display','block'); 
                    
                }
             });   
                               
            }
             
        });
        
         $("#save-prefer").click(function() {
              var submitchild =   $.trim($("#ChildSelect").val());
        var submitfurnished = $.trim($("#FurnishedSelect").val());
        var submitgarden =      $.trim($("#GardenSelect").val());
        var submitdisabled =      $.trim($("#DisabledSelect").val());
         var submitdriveway =   $.trim($("#DrivewaySelect").val());
        var submitsmoker = $.trim($("#SmokerSelect").val());
        var submitpet =      $.trim($("#PetSelect").val());     
         var submitrooms =   $.trim($("#RoomsSelect").val());
        var submittype = $.trim($("#PropertyTypeSelect").val()); 
             
             
              $.post("updatePreferences.php", {Child:submitchild,furnished:submitfurnished,garden:submitgarden,Disabled:submitdisabled,Driveway:submitdriveway,Smoker:submitsmoker,Pet:submitpet,Rooms:submitrooms,Type:submittype}, function(data) {
                  
                     data = $.trim(data);
                   if(data =='UpdateSuccess'){
                   $('#success-section').append('Preferences updated.');
                       $("#success-section").css("display","block");
                   $("#cancel-prefer").css("display","none");
         $("#save-prefer").css("display","none");
         $("#edit-prefer").css("display","block");
             $("#Child").html('');
        $("#Furnished").html('');
        $("#Garden").html('');
        $("#Disabled").html('');
        $("#Driveway").html('');
        $("#Smoker").html('');
        $("#Pet").html('');
        $("#Rooms").html('');
        $("#PropertyType").html('');
             
             
               
            $("#Child").append(submitchild);
        $("#Furnished").append(submitfurnished);
        $("#Garden").append(submitgarden);
        $("#Disabled").append(submitdisabled);
        $("#Driveway").append(submitdriveway);
        $("#Smoker").append(submitsmoker);
        $("#Pet").append(submitpet);
        $("#Rooms").append(submitrooms);
        $("#PropertyType").append(submittype);
                  }
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