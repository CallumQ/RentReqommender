<?php
session_start();
?>
<?php
 




 if (isset($_SESSION['status'])){
 unset($_SESSION['status']);
     unset($_SESSION["accountID"]);
      header("Location:index.php");  

 
 }
?>
