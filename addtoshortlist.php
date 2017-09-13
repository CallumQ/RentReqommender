<?php
session_start();
?>
<?php
include 'connection.php';
$account = $_SESSION['accountID'];
$property = $_POST['propertyid'];
    $select = mysqli_query($con,"SELECT * FROM shortlist WHERE user_ID = $account AND advert_ID = $property");
    $cRow = $select->num_rows;
                 if($cRow >= 1){ echo"already exists";}
                else{
                    
                    
                    
                    
 $insert =mysqli_query($con,"INSERT INTO shortlist(user_ID,advert_ID) VALUES ('$account','$property')");

                }





?>


