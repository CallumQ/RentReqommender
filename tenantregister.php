<?php
session_start();
?>
<?php
include 'connection.php';

$_POST['forename'];
$forename =$_POST['forename'];
$surname =$_POST['surname'];
$email = $_POST['email'];
$confirmemail = $_POST['confirmemail'];
$password = $_POST['password'];
$confirmpassword =$_POST['passwordconfirm'];
if(isset($_POST['childfriendly'])){
$rooms =$_POST['rooms'];
}
else{
    $rooms = 1;
}
if(isset($_POST['childfriendly'])){
    $child = 1;    
}
else{
    $child = 0;
}
if(isset($_POST['furnished'])){
    $furnished = 1;
}
else{
    $furnished = 0;
}

if(isset($_POST['Garden'])){
    $garden = 1;
}
else{
    $garden =0;
    
}
if(isset($_POST['disabled'])){
    $disabled= 1;
}
else{
    $disabled =0;
}
if(isset($_POST['driveway'])){
    $driveway = 1;
}
else{
    $driveway = 0;
}
if(isset($_POST['smoker'])){
    $smoker = 1;
}
else{
    $smoker = 0;
}
if(isset($_POST['pet'])){
    $pet = 1;
}
else{
    $pet =0 ;
}



    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        echo" invalid email";
        
    }
    else{
    $select =mysqli_query($con,"SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'");
      
      // Generating salt
if($select->num_rows >0){
    
    echo "email-exists";
}
else{
       $hashedpass = password_hash($password,PASSWORD_DEFAULT);
      
       try{					

        $conpdo = new PDO('mysql:host=localhost;dbname=example3_rentreq','example3_rentrec','password1234');
        
        //begin atomic transaction
        $conpdo->beginTransaction();
        
        $conpdo->exec("INSERT INTO users (email,password,accountType) VALUES('$email','$hashedpass',1)");
        //get the unique id of the user that was inserted to then add it into the tenant table
        $accountid = $conpdo->lastInsertId();
        
           $insert = "INSERT INTO tenant (User_ID,Forename,Surname,ChildPreference,Furnished,Garden,DisabledAccess,Driveway,SmokerFriendly,PetFriendly,NoOfRooms,propertyType) VALUES ($accountid,'$forename','$surname',$child,$furnished,$garden,$disabled,$driveway,$smoker,$pet,$rooms,'Flat')";
          
        $conpdo->exec($insert);
    
        
        
        $conpdo->commit();
        echo'Success';
       }
        catch (PDOException $e) {
            $conpdo -> rollBack();
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
    
    
    
}
    }

    




?>