<?php
session_start();
?>
<?php
include 'connection.php';


$forename =$_POST['lettingagentname'];
$surname =$_POST['contactname'];
$email = $_POST['email'];
$confirmemail = $_POST['confirmemail'];
$password = $_POST['password'];
$confirmpassword =$_POST['confirmpassword'];

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
        
        $conpdo->exec("INSERT INTO users (email,password,accountType) VALUES('$email','$hashedpass',2)");
        //get the unique id of the user that was inserted to then add it into the tenant table
        $accountid = $conpdo->lastInsertId();
        
           $insert = "INSERT INTO landlord (User_ID,AgencyName,ContactName) VALUES ($accountid,'$forename','$surname')";
          
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