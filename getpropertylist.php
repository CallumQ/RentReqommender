<?php
session_start();
?>
<?php
include 'connection.php';

$persona = $_POST['personaID'];
$proparray= array();
$recommendation = $_POST['recommendationType'];
 $select =mysqli_query($con,"SELECT advert_ID FROM propertytesting where propertytesting.persona_ID = $persona AND recommendationType = $recommendation ");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
      array_push($proparray,$row['advert_ID']);
      
    }
        
                 }
                 
  echo json_encode($proparray);


?>