       
                <?php
       include '../connection.php';         
                
                $count = 0;
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM advert WHERE advert.bedroom BETWEEN 1 AND 2 AND advert.furnsihed =1 and advert.driveway = 1 and advert.pricePerMonth BETWEEN 300 AND 500");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $advertid= $row['advert_ID'];
        $insert = mysqli_query($con,"INSERT INTO shortlist VALUES(NULL,39,$advertid)"); 
        
        
        
                 }}


?>