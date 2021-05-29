<?php

include('../Security.php');
session_start();

if (isset($_POST['loginbtn'])) {
    require	('./mysqli_connect.php');	
    $email=mysqli_real_escape_string($dbc, trim($_POST['logEmail']));
    $pass=mysqli_real_escape_string($dbc, trim($_POST['logPassword']));
$ip=$_POST["IP"];
//    $email=$_POST['logEmail'];
  //  $pass=$_POST['logPassword'];
    $q="SELECT * FROM users WHERE email='$email' AND pass=SHA1('$pass') AND active='true'";
   // $q="SELECT * FROM users WHERE email='4@4.lk' AND pass=SHA1('1')";
    $r=mysqli_query($dbc,$q);
$multilogin=mysqli_fetch_array($r);
  //  if (mysqli_fetch_array($r)>0) 
     
  if($multilogin['role_id']=='1')
        {
          $uids=$multilogin['user_id'];
              //merge guest mode cart items to real user
 $upcart="UPDATE `cart` SET `uid`='$uids' WHERE `IP`='$ip' ";
$rupcart=mysqli_query($dbc,$upcart);

        $_SESSION['username']=$email;	
        $_SESSION['userimg']=$multilogin['images'];	
        $_SESSION['user_levels']=1;	
         header('Location: ../admin/index.php');
        }
      else if($multilogin['role_id']=='2')
      {
        $uids=$multilogin['user_id'];
    
        //merge guest mode cart items to real user
                 $upcart="UPDATE `cart` SET `uid`='$uids' WHERE `IP`='$ip' ";
                 $rupcart=mysqli_query($dbc,$upcart);
        $_SESSION['username']=$email;	
            $_SESSION['userimg']=$multilogin['images'];	
        $_SESSION['user_levels']=2;	
        header('Location: ../admin/index.php');
     
      } 
    else if($multilogin['role_id']=='3')
       {
         $uids=$multilogin['user_id'];
    
//merge guest mode cart items to real user
         $upcart="UPDATE `cart` SET `uid`='$uids' WHERE `IP`='$ip' ";
         $rupcart=mysqli_query($dbc,$upcart);

        $_SESSION['username']=$email;	
        $_SESSION['user_levels']=3;	
        header('Location: ../index.php');
        }

      else {
        $_SESSION['statuslog']="Username and Password Invalid or Account Inactivate";	
        header('Location: ../login.php');
            }
      mysqli_close($dbc);
}






?>