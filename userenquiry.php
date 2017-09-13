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
<!doctype html>
<html lang="en">

<head>
    <script> 
    var accountid = <?php echo $_SESSION['accountID'] ?>;
    var offset = 0;
    var offset1 = 0;
    var offset2 = 0;
    </script>
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
</head>

<body>

    <div class="nav-bar" id="nav-bar">
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
        
            <div class="advert-container1">
        
         <div class="enquiry-container-outer">
            <div class="new-enquiries enquiry-container">
             <div class="enquiry-container-topbutton" id="new-enquiry-button">
                <p>Unanswered enquiries</p>
                <div class="arrow-up enquiry-arrow">
                <i class="fa fa-caret-up" aria-hidden="true" id="new-enquiry-caret"></i>
                </div></div>
             <div class="enquiry-closed" id="new-enquiry">
                <div class="enquiry-containers">
                 <div class="enquiry-row-header">
                <div class="enquiry-row-header-ID"><strong>Enquiry ID</strong></div>
                <div class="enquiry-row-header-Title"><strong>Title</strong></div>
                <div class="enquiry-row-header-Name"><strong>Letting Agent Name</strong></div>
                 <div class="enquiry-row-header-date"><strong>Last Update</strong></div>
                <div class="enquiry-row-header-actions"><strong>Actions</strong></div>
    
                 </div>
                    <?php
                    $NumOfNewQueries = null;
                    $selectQuery = "Select count(DISTINCT EnquiryNumber) as 'count' from enquiry where enquiry.landlord_ID = ". $_SESSION['accountID']. ' AND enquiry.Sender_ID <> '.$_SESSION['accountID'].' AND Status = 1';
                    
                    $numberofrows = mysqli_query($con,$selectQuery);
                        
                      
                    while ($row = mysqli_fetch_assoc($numberofrows)){
                        $NumOfNewQueries = $row['count'];
                        
                    }    
                    if( $NumOfNewQueries >10){
                        $NumOfNewQueries = ceil($NumOfNewQueries / 10);
                        
                    } 
                    else{
                        $NumOfNewQueries = 1;
                    }
                    
                    ?>  
                    <script>
                    var maxoffset = <?php echo $NumOfNewQueries; ?>;
                    
                    </script>
                    <div class="enquiry-row-container-new">
                 
                   </div>
                   
                  </div>
                 
                 <div class="enquiry-numbers" id="enquiry-numbers">
                 Showing page <span id ="current-shown"></span> of <?php echo $NumOfNewQueries ?>
                 </div>
                <div class="enquiry-button">
                 <div class="buttons-backward" id="back-button" title="back"><i class="fa fa-angle-double-left" aria-hidden="true"></i>  </div>
                <div class="buttons-forward" id="forward-button" title="forward"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                 </div>
                  
                  
                </div>
             </div>
            <div class="new-enquiries enquiry-container">
             <div class="enquiry-container-topbutton" id="open-enquiry-button">
                <p>Answered enquiries</p>
                <div class="arrow-up enquiry-arrow">
                <i class="fa fa-caret-up" aria-hidden="true" id="open-enquiry-caret"></i>
                </div></div>
             <div class="enquiry-closed" id="open-enquiry">
                <div class="enquiry-row-header">
                <div class="enquiry-row-header-ID"><strong>Enquiry ID</strong></div>
                <div class="enquiry-row-header-Title"><strong>Title</strong></div>
                <div class="enquiry-row-header-Name"><strong>Letting Agent Name</strong></div>
                 <div class="enquiry-row-header-date"><strong>Last Update</strong></div>
                <div class="enquiry-row-header-actions"><strong>Actions</strong></div>
    
                 </div>
                 
                 
                 
                 
                  <?php
                    $NumOfNewQueries = null;
                    $selectQuery = "Select count(DISTINCT EnquiryNumber) as 'count' from enquiry where enquiry.landlord_ID = ". $_SESSION['accountID']. ' AND enquiry.Sender_ID = '.$_SESSION['accountID'] .' AND Status = 1';
                    
                    $numberofrows = mysqli_query($con,$selectQuery);
                        
                      
                    while ($row = mysqli_fetch_assoc($numberofrows)){
                        $NumOfNewQueries = $row['count'];
                        
                    }    
                    if( $NumOfNewQueries >10){
                        $NumOfNewQueries = ceil($NumOfNewQueries / 10);
                        
                    } 
                    else{
                        $NumOfNewQueries = 1;
                    }
                    
                    ?>  
                    <script>
                    var maxoffset1 = <?php echo $NumOfNewQueries; ?>;
                    
                    </script>
                
                 
                 
                 
                 
                 
                 
                   <div class="enquiry-row-container-answered">
                 
                   </div>
                  
                   <div class="enquiry-numbers" id="enquiry-numbers">
                 Showing page <span id ="current-shown-answered"></span> of <?php echo $NumOfNewQueries ?>
                 </div>
                <div class="enquiry-button">
                 <div class="buttons-backward" id="back-button-answered" title="back"><i class="fa fa-angle-double-left" aria-hidden="true"></i>  </div>
                <div class="buttons-forward" id="forward-button-answered" title="forward"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                 </div>
                  
                  
                </div>
             </div>
             <div class="new-enquiries enquiry-container">
             <div class="enquiry-container-topbutton" id="closed-enquiry-button">
                <p>Closed enquiries</p>
                <div class="arrow-up enquiry-arrow">
                <i class="fa fa-caret-up" aria-hidden="true" id="close-enquiry-caret"></i>
                </div></div>
             <div class="enquiry-closed" id="close-enquiry">
                <div class="enquiry-row-header">
                <div class="enquiry-row-header-ID"><strong>Enquiry ID</strong></div>
                <div class="enquiry-row-header-Title"><strong>Title</strong></div>
                <div class="enquiry-row-header-Name"><strong>Letting Agent Name</strong></div>
                 <div class="enquiry-row-header-date"><strong>Last Update</strong></div>
                <div class="enquiry-row-header-actions"><strong>Actions</strong></div>
    
                 </div>
                 
                 
                 <?php
                    $NumOfNewQueries = null;
                    $selectQuery = "Select count(DISTINCT EnquiryNumber) as 'count' from enquiry where enquiry.landlord_ID = ". $_SESSION['accountID']. ' AND Status = 0';
                    
                    $numberofrows = mysqli_query($con,$selectQuery);
                        
                      
                    while ($row = mysqli_fetch_assoc($numberofrows)){
                        $NumOfNewQueries = $row['count'];
                        
                    }    
                    if( $NumOfNewQueries >10){
                        $NumOfNewQueries = ceil($NumOfNewQueries / 10);
                        
                    } 
                    else{
                        $NumOfNewQueries = 1;
                    }
                    
                    ?>  
                    <script>
                    var maxoffset2 = <?php echo $NumOfNewQueries; ?>;
                    
                    </script>
                 
                 
                 
                 
                 
                 <div class="enquiry-row-container-closed">
                 
                   </div>
                  
                   <div class="enquiry-numbers" id="enquiry-numbers">
                 Showing page <span id ="current-shown-closed"></span> of <?php echo $NumOfNewQueries ?>
                 </div>
                <div class="enquiry-button">
                 <div class="buttons-backward" id="back-button-closed" title="back"><i class="fa fa-angle-double-left" aria-hidden="true"></i>  </div>
                <div class="buttons-forward" id="forward-button-closed" title="forward"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
                 </div>
                  
                  
                </div>
             </div>
    </div></div>
        
        </div>
       
    </body>

    
    <script>
        
        $(document).scroll(function() {
  
    if($(document).scrollTop() > 80){
           $('.sidebar').css('padding-top','0px'); 
        
    }
    else{
           $('.sidebar').css('padding-top','80px'); 
        
    }
});

function function2(){
    
    var height =$( window ).height();
    $("#side-bar").animate({height:height+'px'},100);
    return this;
}function openOpenEnquiry(toggletime){
              $( "#open-enquiry" ).slideToggle(  toggletime, function() {
     $('#open-enquiry').addClass('enquiry-open');
  });
           $('#open-enquiry').removeClass('enquiry-closed');
          
           
           $('#open-enquiry-caret').css('transform','rotate(180deg)');
           
            
        }
     function closeOpenEnquiry(toggletime){
             $( "#open-enquiry" ).slideToggle(  toggletime, function() {
   $('#open-enquiry').addClass('enquiry-closed');
  });
        $('#open-enquiry-caret').css('transform','rotate(0deg)');
      
        $('#open-enquiry').removeClass('enquiry-open');
        }
    
        function openNewEnquiry(toggletime){
              $( "#new-enquiry" ).slideToggle(  toggletime, function() {
    // Animation complete.
  });
           $('#new-enquiry').removeClass('enquiry-closed');
           $('#new-enquiry').addClass('enquiry-open');
           
           $('#new-enquiry-caret').css('transform','rotate(180deg)');
           
            
        }
        function closeNewEnquiry(toggletime){
                $( "#new-enquiry" ).slideToggle(  toggletime, function() {
   $('#new-enquiry').addClass('enquiry-closed');
  });
        $('#new-enquiry-caret').css('transform','rotate(0deg)');
      
        $('#new-enquiry').removeClass('enquiry-open');
        }
        
        
        function openClosedEnquiry(toggletime){
              $( "#close-enquiry" ).slideToggle(  toggletime, function() {
    // Animation complete.
  });
           $('#close-enquiry').removeClass('enquiry-closed');
           $('#close-enquiry').addClass('enquiry-open');
           
           $('#close-enquiry-caret').css('transform','rotate(180deg)');
           
            
        }
        function closeClosedEnquiry(toggletime){
                $( "#close-enquiry" ).slideToggle(  toggletime, function() {
   $('#close-enquiry').addClass('enquiry-closed');
  });
        $('#close-enquiry-caret').css('transform','rotate(0deg)');
      
        $('#close-enquiry').removeClass('enquiry-open');
        }
        
        
        function loadNewEnquiries(){
            $('.enquiry-row-container-new').html('');
     $.post("enquirynewfetcher.php", {offset:offset * 10}, function(data) {
            $('.enquiry-row-container-new').append(data);
     
     });
            
            
        }
        
         function loadClosedEnquiries(){
            $('.enquiry-row-container-closed').html('');
     $.post("enquiryclosed.php", {offset:offset2 * 10}, function(data) {
                   $('.enquiry-row-container-closed').append(data);
     
     });
            
            
        }
        
        
        
        function loadAnsweredQueries(){
            $('.enquiry-row-container-answered').html('');
     $.post("enquiryansweredfetch.php", {offset:offset1 * 10}, function(data) {
                         $('.enquiry-row-container-answered').append(data);
                     
     });
            
            
        }
        
        
        
         $(document).on('click','.reply-send-button',function(){
     var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
             var message = $('#text-area-'+temp).val();
             
             alert(message);
             $.post("newmessage.php", {message:message,EnquiryNo:temp[0]}, function(data) {
                 console.log(data);
                    $('#replied-confirmed-'+temp).css('display','block');
        $('#send-button-'+temp).css('display','none');
     
     });
      

    
    
     });   
        
        
        
        
        
        
        
  
          $(document).on('click','.actions-close',function(){
     var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
   
    temp = "perma-close-"+temp;
        $('#'+temp).css('display','block');
    
     });   
        
        
        
        
        

        
           
        $(document).on('click','.actions-close-no',function(){
     var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
    temp = "perma-close-"+temp;
   $('#'+temp).css('display','none');
    
    
     });   
        
        
        
        
        
        
        $(document).on('click','.actions-expand',function(){
        var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
   
    temp = "expanded-"+temp;
    if ($(this).hasClass('opened')){
         $('#'+temp).addClass('enquiry-closed enquiry-minimised');
        $(this).removeClass('opened');
    }
    else{
         $(this).addClass('opened');
   
    
    $('#'+temp).removeClass('enquiry-closed enquiry-minimised');
    }
   
     });   
        
        
        
        
        
        
     $(document).on('click','.actions-reply',function(){
        var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
   
    temp = "replied-"+temp;
    if ($(this).hasClass('opened')){
         $('#'+temp).addClass('enquiry-closed enquiry-minimised');
        $(this).removeClass('opened');
    }
    else{
         $(this).addClass('opened');
   
    
    $('#'+temp).removeClass('enquiry-closed enquiry-minimised');
        $('#'+temp).addClass('enquiry-open ');
    }
     });   
        
        
        
        
        
        
        
        
        
        
        
        
        
        $(document).on('click','.actions-close-yes',function(){
              var temp = $(this).attr('id');
     temp = temp.match(/\d+/);
         var id = temp;
       console.log(id);
    temp = "row-"+temp;
    $.post("closeEnquiry.php", {enquiryNo:id[0]}, function(data) {
      console.log(data);
        $('#'+temp).css('display','none');
     
     });
    
        
            
            
        });
        
        
        
  
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
 $(function () { 
     
     
     loadNewEnquiries();
     loadClosedEnquiries();
     loadAnsweredQueries();
     $('#current-shown').append(offset+1);
      $('#current-shown-answered').append(offset1+1);
      $('#current-shown-closed').append(offset2+1);
     $('#back-button').click(function(){
        if (offset > 0){
            offset--;
            loadNewEnquiries();
            $('#current-shown').html('');
          $('#current-shown').append(offset+1);
        } 
         
     });
     
     $('#back-button-answered').click(function(){
        if (offset1 > 0){
            offset1--;
            loadAnsweredQueries();
            $('#current-shown-answered').html('');
          $('#current-shown-answered').append(offset1+1);
        } 
         
     });
     
     $('#forward-button-answered').click(function(){
        if (offset1 < maxoffset1-1){
            offset1++;
            loadAnsweredQueries();
            $('#current-shown-answered').html('');
          $('#current-shown-answered').append(offset1+1);
        } 
         
     });
     
     
     
     
     
     
     
      $('#back-button-closed').click(function(){
        if (offset2 > 0){
            offset2--;
            loadClosedEnquiries();
            $('#current-shown-closed').html('');
          $('#current-shown-closed').append(offset1+1);
        } 
         
     });
     
     $('#forward-button-closed').click(function(){
        if (offset2 < maxoffset2-1){
            offset2++;
            loadClosedEnquiries();
            $('#current-shown-closed').html('');
          $('#current-shown-closed').append(offset2+1);
        } 
         
     });
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     $('#forward-button').click(function(){
        if (offset < maxoffset-1){
            offset++;
            loadNewEnquiries();
            $('#current-shown').html('');
          $('#current-shown').append(offset+1);
        } 
         
     });
     
     
     
     
     
     
     
     
     // DOM ready
closeNewEnquiry(0);
openNewEnquiry(500);
closeOpenEnquiry(0);
closeClosedEnquiry(0);
    $('#new-enquiry-button').click(function(){
      
       if( $('#new-enquiry').hasClass('enquiry-closed')){
          openNewEnquiry(300);
       }
        else{
            closeNewEnquiry(300);
        }
        });
     
     
     
     $('#open-enquiry-button').click(function(){
      
       if( $('#open-enquiry').hasClass('enquiry-closed')){
           openOpenEnquiry(300);
       }
        else{
            closeOpenEnquiry(300);
        }
    });
     
     
     $('#closed-enquiry-button').click(function(){
      
       if( $('#close-enquiry').hasClass('enquiry-closed')){
        openClosedEnquiry(300);
       }
        else{
        closeClosedEnquiry(300);
            
        }
           
    });

 }); 
        
        
        
        
</script>
    
    
</html>