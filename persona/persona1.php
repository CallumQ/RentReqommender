       
                <?php
       include '../connection.php';         
                
                $count = 0;
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM `advert` WHERE bedroom >= 2 and childFriendly = 1 AND garden = 1 AND pricePerMonth < 400");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $advertid= $row['advert_ID'];
        $insert = mysqli_query($con,"INSERT INTO shortlist VALUES(NULL,38,$advertid)"); 
        
        
        
                 }}


?>