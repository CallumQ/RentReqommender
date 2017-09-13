


    
                <?php
       include '../connection.php';         
                
                $count = 0;
                
                
                
                 $select =mysqli_query($con,"SELECT * FROM advert where advert.pet = 1 AND advert.bedroom BETWEEN 2 AND 3 AND advert.pricePerMonth BETWEEN 550 AND 650");
   
                 $cRow = $select->num_rows;
                 if($cRow >= 1){
       
    while ($row = mysqli_fetch_assoc($select)){
        $advertid= $row['advert_ID'];
        $insert = mysqli_query($con,"INSERT INTO shortlist VALUES(NULL,42,$advertid)"); 
        
        
        
                 }}


?>