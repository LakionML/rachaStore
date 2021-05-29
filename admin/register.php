 
<?php

include('../Security.php');
//newuserbtn
//if(isset($_POST['editDetailsBtn']))

//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//This triggers when the new user button is clicked
if(isset($_POST['newuserbtn']))
{
   require	('./mysqli_connect.php');	
$e=trim($_POST['email']);
$emailvalid="SELECT * FROM users WHERE email='$e'";
$erun=mysqli_query($dbc,$emailvalid);
if (mysqli_num_rows($erun)>0) {

  $_SESSION['status']="Email address Already  Taken";	
  header('Location: ViewUsers.php');

}
else {



    if (!empty($_POST['first_name'])&&!empty($_POST['last_name'])&&!empty($_POST['email'])&& ($_POST['password1'] == $_POST['password2']))
  //  (file_exists("../../uploads/".$_FILES['user_img']['name']))) 
    {
		
       $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
        $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
        $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $p = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $ul = mysqli_real_escape_string($dbc, trim($_POST['usertype']));
         //   $ut = mysqli_real_escape_string($dbc, trim($_POST['usertype']));
        $image_encoded=$_FILES['user_img']['name'];
         //     $q = "INSERT INTO users (first_name, last_name, email, pass, user_level, registration_date,images) VALUES ('$fn', '$ln', '$e', SHA1('$p'),'$ut', NOW(),'$image_encoded')";		

            $q = "INSERT INTO users (first_name, last_name, email, pass,role_id, registration_date,images) VALUES ('$fn', '$ln', '$e', SHA1('$p'),'$ul', NOW(),'$image_encoded')";		
		        $r = @mysqli_query ($dbc, $q);

           if ($r)
            { 
            move_uploaded_file($_FILES["user_img"]["tmp_name"],"../../uploads/".$_FILES['user_img']['name']);
            $_SESSION['success']="You are now Registered successfully";	
            header('Location: ViewUsers.php');
          
            } 
      
          else 
           { 
            	
            $_SESSION['status']="You could not be Registered due to a system error";	
            header('Location: ViewUsers.php');
           } 
        
			mysqli_close($dbc);
    }
    else
    {
       
        $_SESSION['status']="Check Entered Details";	
        header('Location: ViewUsers.php');
    }
    
    




  }
}
//This triggers when the user clicks on edit button
if(isset($_POST['editDetailsBtn']))
{
  require	('./mysqli_connect.php');	
  $id=$_POST['edit_id'];
   $firstName=$_POST['first_name'];
   $lasttName=$_POST['last_name'];
   $email=$_POST['email'];
   $userType=$_POST['usertype'];
   $q="UPDATE `users` SET `first_name`='$firstName',`last_name`='$lasttName',`email`='$email',`role_id`='$userType'  WHERE user_id='$id'";
   //$q="UPDATE `users` SET first_name='$firstName' WHERE user_id=73";
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="You edited user successfully";	
          header('Location: ViewUsers.php');
          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Your data not updated !";	
            header('Location: ViewUsers.php');
 
        }

}
////This triggers when the update password button is clicked
if(isset($_POST['updatepassbtn']))
{
  require	('./mysqli_connect.php');	
   $id=$_POST['edit_id'];
   $pass=$_POST['updateinput'];
  
   $q = "UPDATE users SET pass=SHA1('$pass') WHERE user_id='$id'";	
 
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="updated password successfully";	
          header('Location: ViewUsers.php');
          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Your data not updated !";	
            header('Location: ViewUsers.php');
 
        }

}
//This triggers when the update image button is clicked
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
//This triggers when delete user button is clicked
if(isset($_POST['delbtn']))
{

     
      $id=$_POST['removeid'];
      
          if($id>0){
        require	('./mysqli_connect.php');	
   
        $q=" DELETE FROM `users` WHERE user_id='$id'";
        $r=mysqli_query($dbc,$q);
        $_SESSION['success']="User successfully Deleted "."User Id:  ".$id ;	
        header('Location: ViewUsers.php');
        
        }
              
      else {
               
        $_SESSION['success']="User cannot be Deleted "."User Id:  ".$id ;	
        header('Location: ViewUsers.php');
              
      }

}





//This triggers when delete category button is clicked
if(isset($_POST['DeleteCatBtn']))
{

     
      $id=$_POST['deletecat_id'];
      
          if($id>0){
        require	('./mysqli_connect.php');	
   
        $q=" DELETE FROM `categories` WHERE category_id='$id'";
        $r=mysqli_query($dbc,$q);
        $_SESSION['success']="Category successfully Deleted "."Category Id:  ".$id ;	
        header('Location: Categories.php');
        
        }
              
      else {
               
        $_SESSION['status']="Category cannot be Deleted "."Category Id:  ".$id ;	
        header('Location: Categories.php');
              
      }
        
            


}
//This triggers when delete post button is clicked
if(isset($_POST['DelPost']))
{

     
      $id=$_POST['removepostid'];
      
          if($id>0){
        require	('./mysqli_connect.php');	
   
        $q=" DELETE FROM `messages` WHERE message_id='$id'";
        $r=mysqli_query($dbc,$q);
        $_SESSION['success']="Post successfully Deleted "."Post Id:  ".$id ;	
        header('Location: ForumManagement.php');
        
        }
              
      else {
               
        $_SESSION['status']="Post cannot be Deleted "."Post Id:  ".$id ;	
        header('Location: ForumManagement.php');
              
      }
        
            


}



//This triggers when delete comment button is clicked
if(isset($_POST['delcommentbtn']))
{

     
      $id=$_POST['removecommentid'];
      
          if($id>0){
        require	('./mysqli_connect.php');	
   
        $q=" DELETE FROM `posts` WHERE post_id='$id'";
        $r=mysqli_query($dbc,$q);
        $_SESSION['success']="Comment successfully Deleted "."Comment Id:  ".$id ;	
        header('Location: ForumManagement.php');
        
        }
              
      else {
               
        $_SESSION['status']="Comment cannot be Deleted "."Comment Id:  ".$id ;	
        header('Location: ForumManagement.php');
              
      }

}
//To mark if the order is completed from pending status
if(isset($_GET['done']))
{
  print_r($_GET['done']);
$osid=$_GET['done'];
  require	('./mysqli_connect.php');	
   $q="UPDATE `orders` SET  `order_status`=1 WHERE `id`='$osid'";
 
   $r=mysqli_query($dbc,$q);
       if ($r) {
           $_SESSION['success']="Order Completed";	
          header('Location: Orders.php');

          mysqli_close($dbc);
        }
       else 
        {
            $_SESSION['success']="Order not Completed !";	
            header('Location: Orders.php');
 
        }

}





?>

