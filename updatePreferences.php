<?php
session_start();
?>       
<?php
       include 'connection.php';   
$user_ID = $_SESSION['accountID'];
$child = $_POST['Child'];
$furnished = $_POST['furnished'];
$garden = $_POST['garden'];
$disabled = $_POST['Disabled'];
$driveway = $_POST['Driveway'];
$smoker = $_POST['Smoker'];
$pet = $_POST['Pet'];
$rooms = $_POST['Rooms'];
$type = $_POST['Type'];
if($child =='Yes'){
    $child = 1;
    
}
else{
    $child = 0;
    
}
if($furnished =='Yes'){
    $furnished = 1;
    
}
else{
    $furnished = 0;
    
}
if($garden =='Yes'){
    $garden = 1;
    
}
else{
    $garden = 0;
    
}
if($disabled =='Yes'){
    $disabled = 1;
    
}
else{
    $disabled = 0;
    
}
if($driveway =='Yes'){
    $driveway = 1;
    
}
else{
    $driveway = 0;
    
}
if($smoker =='Yes'){
    $smoker = 1;
    
}
else{
    $smoker = 0;
    
}
if($pet =='Yes'){
    $pet = 1;
    
}
else{
    $pet = 0;
    
}
if($rooms =='5+'){
    $rooms = 5;
    
}


    
    $updatePreferences = "UPDATE tenant set ChildPreference = $child, Furnished = $furnished, Garden = $garden,DisabledAccess = $disabled, Driveway = $driveway,  SmokerFriendly = $smoker, PetFriendly = $pet, NoOfRooms = $rooms, PropertyType = '$type' WHERE User_ID = $user_ID";
   

    $result = mysqli_query($con,$updatePreferences);
    if($result){
        echo 'UpdateSuccess';
        
        
        
    }
    else{
        echo' error';
    }

?>