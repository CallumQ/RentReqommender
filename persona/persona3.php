       
                <?php
       include '../connection.php';         
                
                $count = 0;
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM advert WHERE advert.bedroom = 4 AND advert.furnsihed =1 and advert.garden = 1 AND advert.driveway = 1 and advert.pricePerMonth BETWEEN 600 AND 800 AND advert.bathrooms BETWEEN 1 AND 2");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $advertid= $row['advert_ID'];
        $insert = mysqli_query($con,"INSERT INTO shortlist VALUES(NULL,40,$advertid)"); 
        
        
        
                 }}


?>