<?php
session_start();
?>
<?php
include 'connection.php';

$propertyid = $_POST['advert_ID'];
    
$query = "DELETE FROM advert WHERE advert_ID = $propertyid";
    $Delete = mysqli_query($con,$query);
echo $query;
 if($Delete){
        echo'success';}
else{
    
    echo' error';
}

?>