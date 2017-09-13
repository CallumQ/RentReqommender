


    
                <?php
       include '../connection.php';         
                
                $count = 0;
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM advert where advert.smoker = 1 AND 
advert.furnsihed = 1 AND advert.propertyType = 'Flat' AND advert.bedroom = 1");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $advertid= $row['advert_ID'];
        $insert = mysqli_query($con,"INSERT INTO shortlist VALUES(NULL,41,$advertid)"); 
        
        
        
                 }}


?>