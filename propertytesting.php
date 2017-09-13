<?php
session_start();
?>
<?php
include 'connection.php';

$recommendationType = 1;
$personaID = rand(1590,1592);
$select =mysqli_query($con,"SELECT recommendationMethod, persona_ID from testratings
order by uniqueID desc
limit 1");
   if($select){
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       $recommendationType;
    while ($row = mysqli_fetch_assoc($select)){
      $lastType = $row['recommendationMethod'];
        $lastPersona = $row['persona_ID'];
      
    }
                 }
       
                 }
    

?>
    


<html>
    <head>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/index2.css">
    <style>
        @media only screen and (max-width: 1280px) {
            .instructions{
                
                font-size: 14px;
            }
            
            .font-resize{
                
                font-size: 10px;
            }
        }
        
        .button{
            padding-left: 60px;
    padding-right: 60px;
        }
        .yesnosection{
          position: absolute;
          margin-left: auto;
            margin-right: auto;
            display: inline;
bottom: 10px;
        }
        .support{
            width: 100%;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            bottom: 10px;    
        }
       
        
        </style>
    </head>
    <body>
    <div class="instructions">
        <div class="instructions-title" style="text-align:center; padding-top:0px;">
        Instructions
        </div>
        <div class="instructions-description" style="text-align:center; margin-top:20px; padding-right:40px; padding-left:40px; padding-bottom:10px; border-bottom:1px solid rgba(0,0,0,0.4);">Based on the example user below, use the slider to select how suitable you think the property is for the example user. You can choose between strongly disagee, disagree, agree, strongly agree, or undecided if you are unsure.</div>
        <div class="persona-title" style="text-align:center; padding-top:10px; padding-bottom:10px;">Persona Details</div>
        <div class="persona-description" style="text-align:center;">
            
            <img src="Image/personaImages/persona<?php echo $personaID ?>.png" style="padding-left:90px; padding-right:90px;">
            <p style="padding-top:10px; padding-left:40px; padding-right:40px;">
                
                <?php if($personaID==1590){
            echo 'A family of 4 are looking to rent a 3 bedroom house. The property needs to have a driveway and also a garden for their small children. They would also like a house that accepts pets as they may be looking to get a dog in the near future. they have a budget in the region of £800-900 a month to spend on rent.';
    
    
} 
                
                else if( $personaID == 1591){
                    echo' Susan is a business consultant who is looking for a 2 bedroom property. She has to move in as soon as possible so the house must be furnished. As she will also be commuting a driveway is a nessecity. She\'s an occasional smoker, but a property that doesn\'t allow smokers is not a dealbreaker. She has a budget of £500 per month.';  
                    
                }
                
                
                else if( $personaID == 1592){
                    echo' John is looking to rent a property, and he has a budget of roughly £750 a month. The property must have at least 3 bedrooms as his children sometimes stay with him. He has 2 dogs so a property that allows pets is a must. He would also like a driveway, but not having a driveway isn\'t a deal breaker. Access to a garden is also important for his children';  
                    
                }?> 
                
                
              
            
            
            </p>
        
        
        <div class="support">Any questions or problems contact <a href="mailto:crq1@hw.ac.uk?Subject=user%20testing" target="_top">crq1@hw.ac.uk</a></div>
        </div>
        </div>
    <div class="property-window">
       <div class="main-body-content" style="top:0; height:89.7%;">
        <div class="completion"><div class="child">
            
            The study is now complete. Thank you for taking part.</div></div>
           <div class="main-body-content" id="main-body-id" style="top:0; height:100%;">
        
         
        </div>
        </div>
        </div>
        
        <div class="row bottom-buttons">
        <div class="medium-12 columns">
            <div class="center">
                <p>
            Is this property suitable for the persona on the left?
                </p>
              <input type="range" id="rangeInput" name="rangeInput" step="1" min="1" max="5">
                <label id="rangeText" style=" color:black;"/>
                
            </div>
            <div class="button" id="nobutton">submit</div>
            
            </div></div>
        
    </body>
            <script type="text/javascript">
                var rangeValues =
{
    "1": "Strongly Disagree",
    "2": "Disagree",
    "3": "Undecided",
    "4": "Agree",
    "5": "Strongly Agree"
};

     var sliderPos = 0 ;
          var personaID = <?php echo $personaID ?>;
    var recommendationType = <?php
    echo $recommendationType ?>;
              var propertyList = [];
                var currentproperty;
                var ratedProperties = [];
                
                      $(function () {

    // on page load, set the text of the label based the value of the range
    $('#rangeText').text(rangeValues[$('#rangeInput').val()]);

    // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
    $('#rangeInput').on('input change', function () {
    sliderPos =$(this).val() ;
      
        $('#rangeText').text(rangeValues[$(this).val()]);
    });

});     
                 $("#yesbutton").click(function() {
                    
                     ratedProperties.push([currentproperty,1]);
                     if (propertyList.length >0){
                         
                  getproperty(propertyList[0]); 
                        currentproperty = (propertyList.shift());
            }
                 else{
               
                        var personaID1 = <?php echo $personaID?>;
                         insertresults();
                        if (recommendationType >= 3){
                           
                            $("#main-body-id").html(' ');
                        $(".completion").css("display", "block");
                     $('.completion').css('opacity', '1');
                           
                       }
                     else{
                         console.log(ratedProperties);
                     recommendationType ++;
                       ratedProperties = [];
                    $.post("getpropertylist.php", {personaID: personaID1 ,recommendationType: recommendationType}, function(data) {
                   propertyList = eval(data);
                       getproperty(propertyList[0]); 
                       currentproperty = (propertyList.shift());
            });}
                    
                    
                }
                     
                 });
                 
               
                
                
                
                $("#nobutton").click(function() {   
                sliderPos =$('#rangeInput').val() ;
                        ratedProperties.push([currentproperty,sliderPos]);
                    $('#rangeInput').val('3');
                    $('#rangeText').text(rangeValues[3]);
                    if (propertyList.length >0){
                     
                  getproperty(propertyList[0]); 
                        currentproperty = (propertyList.shift());
            }
                 else{
                       console.log(ratedProperties);
                        var personaID1 = <?php echo $personaID?>;
                         insertresults();
                     ratedProperties =[];
                        if (recommendationType >= 3){
                           
                            $("#main-body-id").html(' ');
                        $(".completion").css("display", "block");
                     $('.completion').css('opacity','1');
                           
                       }
                     else{
                     recommendationType ++;
                 
                    $.post("getpropertylist.php", {personaID: personaID1 ,recommendationType: recommendationType}, function(data) { 
                        
                   propertyList = eval(data);
                    
                        getproperty(propertyList[0]); 
                       currentproperty = (propertyList.shift());
            });}
                    
                    
                }
                 });
                $( document ).ready(function() {
                    
                    var personaID1 = <?php echo $personaID?>;
                    var recommendationType1 = <?php echo $recommendationType ?>;
                    $.post("getpropertylist.php", {personaID: personaID1 ,recommendationType: recommendationType1}, function(data) {
                   propertyList = eval(data);
                        console.log("persona ID"+ personaID1);
                        console.log("Rec type"+recommendationType1);
                           console.log(propertyList);
                       getproperty(propertyList[0]); 
                       currentproperty = (propertyList.shift());
            });
                    
                    
                });
                
                function getproperty(propID){
                     $.post("propertyfetcher.php", {
                        propertyID: propertyList[0]
                    },
                    function(data) {
                      $("#main-body-id").html(' ');
                 $("#main-body-id").append(data);

                    });
                    
                    
                }
                
                function insertresults(){
                    $.post("propertyinserter.php", {
                        propertyArray: JSON.stringify(ratedProperties),personaNo: personaID, recommendationMethod: recommendationType
                    },
                    function(data) {
                 

                    });
                    
                    
                }
                
function select_img(src) {

  document.getElementById("bigimg").style.backgroundImage ="url('"+src+"')";
}
    

 function addToShortlist(element) {
                var thenum = (element.id).replace(/^\D+/g, '');

                $.post("addtoshortlist.php", {
                        propertyid: thenum
                    },
                    function(data) {


                    });
              $('#'+element.id+'-text').text("Liked!");
                return false;

            }

            
           
            function QueryDatabase() {
                
              var distance = $('#distancechecker').val();
                var pageNo = "&pageNo="+pagenum;
                if (distance != null){
                    
                    if ($('#postcode').val() != ''){
                            var geocoder = new google.maps.Geocoder();
                var address = postcode;
                var coords = "";
                geocoder.geocode({
                    'address':  ($("#postcode").val())
                }, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        
                        coords = "&Latitude=" + results[0].geometry.location.lat() + "&Longitude=" + results[0].geometry.location.lng();
                    

                
             


                data = $('form').serialize();
             data += coords;
                        data+= pageNo;
                console.log(data)
//
               $('.modal').css("display", "block");
              $('.advert-container1').addClass("loading");
//

             $.get("searchscript.php", data, function(data) {
                    $(".advert-container1").html(' ');
                 $(".advert-container1").append(data);
                $('.modal').css("display", "none");
                  $('.advert-container1').removeClass("loading");

            });

                return false;
                    }



            }
                                 )
                        
                        
                    }
                    
                    else{
                        
                       document.getElementById("postcode").focus();
                    }
                    
                }
                
            }
        </script>
</html>