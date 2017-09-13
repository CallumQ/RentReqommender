<?php
session_start();
?>
<?php
include 'connection.php';
$proparray = json_decode($_POST['propertyArray']);
$personaNumber = $_POST['personaNo'];
$recommendationType = $_POST['recommendationMethod'];

foreach($proparray as $arr ){
$select =mysqli_query($con,"INSERT INTO testratings (persona_ID,propertyID, recommendationMethod,rating) VALUES($personaNumber,$arr[0],$recommendationType,$arr[1])");
}
?>




