<?php
session_start();
?>
<?php
include 'connection.php';
############ Configuration ##############
$config["image_max_size"]               = 400; //Maximum image size (height and width)
$config["thumbnail_size"]               = 200; //Thumbnails will be cropped to 200x200 pixels

$config["destination_folder"]           = 'Image/propertyImages/'; //upload directory ends with / (slash)
 //upload directory ends with / (slash)
$config["upload_url"]                   = "Image/propertyImages/"; 
$config["quality"]                      = 100; //jpeg quality
$folder = "";
$rent = $_POST['rent'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$postcode = $_POST['postcode'];
$rooms = $_POST['Rooms'];
$bathroom = $_POST['bathrooms'];
$type = $_POST['PropertyType'];
$landlordID = $_SESSION['accountID'];
$long = $_POST['longitude'];
$lat = $_POST['latitude'];
$fileName = [];
$lastID = 0;
$advert_ID = $_POST['advert_ID'];
if($_POST['desc'] == ''){
    $desc = "No description.";
    
}
else{
    $desc = $_POST['desc'];
    
}
if(isset($_POST['childfriendly'])){
    $childfriendly = 1;
    
}
else{
    $childfriendly = 0;
    
}

if(isset($_POST['furnished'])){
    $furnished = 1;
    
}
else{
    $furnished = 0;
    
}
if(isset($_POST['Garden'])){
    $garden = 1;
    
}
else{
    $garden = 0;
    
}

if(isset($_POST['disabled'])){
    $disabled = 1;
    
}
else{
    $disabled = 0;
    
}

if(isset($_POST['driveway'])){
    $driveway = 1;
    
}
else{
    $driveway = 0;
    
}
if(isset($_POST['smoker'])){
    $smoker = 1;
    
}
else{
    $smoker = 0;
    
}

if(isset($_POST['pet'])){
    $pet = 1;
    
}
else{
    $pet = 0;
    
}




if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    exit;  //try detect AJAX request, simply exist if no Ajax
}
$insertString = "UPDATE advert SET pricePerMonth = $rent,address1 =' $address1',address2 ='$address2',address3 = '$address3',postcode = '$postcode', bedroom = $rooms,bathrooms = $bathroom,description = '$desc',childFriendly = $childfriendly,furnsihed = $furnished,garden = $garden,disabled = $disabled,driveway = $driveway,smoker = $smoker,pet = $pet,propertyType = '$type',Longitude= $long,Latitude= $lat WHERE advert_ID = $advert_ID";
echo $insertString;
$insertProperty =mysqli_query($con,$insertString);

    if($insertProperty){
        echo'success';}
else{
    
    echo' error';
}

    

