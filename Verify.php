<?php
  require	('./mysqli_connect.php');
  //verification of new users	
if(isset($_GET['VerifyCode'])){
$vcode=$_GET['VerifyCode'];
echo'Activated';
$q="UPDATE `users` SET `active`='true' WHERE`VerifyCode`='$vcode'"; 
 $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="Account Activated successfully";	
           header('Location: login.php');
           mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Your Account not Activated !";	
            
 
        }
}
else {
    die("Something went wrong with your activation code, Please contact Admin");
}
?>

