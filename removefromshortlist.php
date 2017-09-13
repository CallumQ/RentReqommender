<?php
session_start();
?>
<?php
include 'connection.php';
$account = $_SESSION['accountID'];
$property = $_POST['propertyid'];
 $insert =mysqli_query($con,"DELETE FROM shortlist WHERE user_ID = $account AND advert_ID= $property");

                





?>


