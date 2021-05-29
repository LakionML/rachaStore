 
<?php
session_start();
//include('../Security.php');
//newuserbtn
//if(isset($_POST['editDetailsBtn']))

//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//New User registration 
if(isset($_POST['newuserbtn']))
      {
        require	('./mysqli_connect.php');	
      $e=trim($_POST['email']);
      $emailvalid="SELECT * FROM users WHERE email='$e'";
      $erun=mysqli_query($dbc,$emailvalid);
      if (mysqli_num_rows($erun)>0) {

        $_SESSION['status']="Email address Already  Taken";	
        header('Location: Register.php');

      }
      else {



          if (!empty($_POST['FirstName'])&&!empty($_POST['LastName'])&&!empty($_POST['email'])&& ($_POST['password1'] == $_POST['password2']))

          {
          
            $fn = mysqli_real_escape_string($dbc, trim($_POST['FirstName']));
              $ln = mysqli_real_escape_string($dbc, trim($_POST['LastName']));
              $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
              $p = mysqli_real_escape_string($dbc, trim($_POST['password1']));

              $address=mysqli_real_escape_string($dbc, trim($_POST['Address']));
              $city=mysqli_real_escape_string($dbc, trim($_POST['City']));
              $mobile=mysqli_real_escape_string($dbc, trim($_POST['Mobile']));
              $verifyCode=md5(time().$email);

            //  $image_encoded=$_FILES['user_img']['name'];
            $image_encoded='default.png';
              //     $q = "INSERT INTO users (first_name, last_name, email, pass, user_level, registration_date,images) VALUES ('$fn', '$ln', '$e', SHA1('$p'),'$ut', NOW(),'$image_encoded')";		

                  $q = "INSERT INTO users (first_name, last_name, email, pass, registration_date,images,Address, City, Mobile,VerifyCode) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(),'$image_encoded','$address','$city','$mobile','$verifyCode')";		
                  $r = @mysqli_query ($dbc, $q);
          
                if ($r)
                  { 
                // move_uploaded_file($_FILES["user_img"]["tmp_name"],"../../uploads/".$_FILES['user_img']['name']);
                  $_SESSION['success']="You are now Registered successfully Thank you for  
                  Registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.";	
                
                //Activation through email
                $To=$e.',20laklira@gmail.com';
                $subject="Your Email Verification";
                $messge="<a href='http://racha.foxxy.xyz/htdocs/Verify.php?VerifyCode=$verifyCode'>Activate Your Shopping Account</a>";
                $header="From:20laklirsa@gmail.com\r\n " .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8';
                mail($To,$subject,$messge,$header);
                header('Location: Register.php');
                  } 
            
                else 
                { 
                    
                  $_SESSION['status']="You could not be Registered due to a system error";	
                  header('Location: Register.php');
                } 
              
            mysqli_close($dbc);
          }
          else
          {
            
              $_SESSION['status']="Check Entered Details";	
              header('Location: Register.php');
          }
          
          




        }
}
//Update user details
if(isset($_POST['updateuserbtn']))
{
  require	('./mysqli_connect.php');

  $uid=$_POST['uid'];
  $fn = $_POST['FirstName'];
  $ln = $_POST['LastName'];
  
  $address=$_POST['Address'];
  $City=$_POST['City'];
  $mobile=$_POST['Mobile'];
  
   $q="UPDATE `users` SET `first_name`='$fn',`last_name`='$ln',`Address`='$address',City='$City',Mobile='$mobile'  WHERE user_id='$uid'";
   //$q="UPDATE `users` SET first_name='$firstName' WHERE user_id=73";
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="You edited User Profile successfully";	
          header('Location: UserProfile.php');
          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Your data not updated !";	
            header('Location: UserProfile.php');
 
        }

}
//updates password
if(isset($_POST['updatepassbtn']))
{
  require	('./mysqli_connect.php');	
   $id=$_POST['uid'];
   $pass=$_POST['updateinput'];
  
   $q = "UPDATE users SET pass=SHA1('$pass') WHERE user_id='$id'";	
 
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="updated password successfully";	
          header('Location: UserProfile.php');
          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Your data not updated !";	
            header('Location: UserProfile.php');
 
        }

}
//updates user image
if(isset($_POST['updateImgbtn']))
{
  //  $fileupload = $_POST['user_img'];
  if (($_FILES['user_img']['name'])!=null) {
    require	('./mysqli_connect.php');	
    $id=$_POST['edit_id'];
    $pass=$_POST['updateinput'];
    $image_encoded=$_FILES['user_img']['name'];
    $q="UPDATE users SET images='$image_encoded' WHERE user_id='$id' ";
    $r = @mysqli_query ($dbc, $q);
 
         if ($r) { 
             
             move_uploaded_file($_FILES["user_img"]["tmp_name"],"../../uploads/".$_FILES['user_img']['name']);
             $_SESSION['success']="Updated successfully";	
             header('Location: ViewUsers.php');
           
         } else { 
                 
             $_SESSION['status']="You could not be updated";	
             header('Location: ViewUsers.php');
         } 
         
             mysqli_close($dbc);
  }
  else
  {
  
    header('Location: ViewUsers.php');

  }
 
}



if(isset($_POST['DeleteBtna']))
{
  require	('./mysqli_connect.php');	
  $id=$_POST['delete_ida'];
  $name=$_POST['delete_name'];
   $q=" DELETE FROM `users` WHERE user_id='$id'";
   //$q="UPDATE `users` SET first_name='$firstName' WHERE user_id=73";
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="User successfully Deleted "."User name:  ".$name ;	
          header('Location: ViewUsers.php');
          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="User Deleted !";	
            header('Location: ViewUsers.php');
 
        }

}



?>

