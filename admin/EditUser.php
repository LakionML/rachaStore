<?php 
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');

?>   

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Change User Details</h1>

<?php 
//Shows the error and successfull messages
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
echo'<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
unset($_SESSION['success']);


}
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    echo'<div class="alert alert-danger" role="alert">'.$_SESSION['status'].'</div>';
    unset($_SESSION['status']);     
}
//Shows the error and successfull messages
?>

<p class="mb-4">Edit User</p>
<div class="row">
<div class="col-xl-8 col-lg-7">

     
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change User Details</h6>
                </div>
                <div class="card-body">
                
                 
                   

 <?php
 //Retrieve data from user edit
require	('./mysqli_connect.php');	
if (isset($_POST['editBtn'])) {
  $id=$_POST['edit_id'];
 
  $q="select * from users where user_id='$id'";
  $rows=mysqli_query($dbc,$q);
  foreach($rows as $r)
  {
 ?>


<form action="register.php" method="POST" enctype="multipart/form-data" >
  

   <div class="form-group">
    <label>User ID</label>
    <input type="text" hidden class="form-control" value="<?php echo $_POST['edit_id'] ?>" name="edit_id" required>
    <label><?php echo $_POST['edit_id'] ?></label>
  </div> 

   <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" value="<?php echo $r['first_name'] ?>" name="first_name" required>
  </div> 
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" value="<?php echo $r['last_name'] ?>"  name="last_name"  required>
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" value="<?php echo $r['email'] ?>" name="email" aria-describedby="emailHelp" required>
    </div>
    <div class="form-group">
  <select class="custom-select" name="usertype" required>
  
    <option value="1" <?php if ($r['role_id'] == '1') echo ' selected="selected"'; ?>>Admin</option>
    <option value="2"<?php if ($r['role_id'] == '2') echo ' selected="selected"'; ?>>Staff</option>
    <option value="3"<?php if ($r['role_id'] == '3') echo ' selected="selected"'; ?>>Customer</option>
  </select>
</div>

<?php 
}
} 
//Retrieve data from user edit
?> 

<hr>
<button type="submit" name="editDetailsBtn" class="btn btn-primary">Update</button>
<a href="ViewUsers.php" class="btn btn-danger">Cancel</a>

 </div>
</div>

          
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <div class="card-body">
                <form class="form-inline">

  <div class="form-group mx-sm-3 mb-2">
     <div class="form-group">
    
    <input type="text" hidden class="form-control" value="<?php echo $_POST['edit_id'] ?>" name="edit_id">
  </div> 
  <div class="form-group">
  <label for="inputPassword2" class="sr-only">Password</label>
    <input type="password" name="updateinput" class="form-control" id="show_hide_password" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" onclick="myFunction()"  class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Show Password</label>
  </div>
  </div>
                  <hr>
 
                  <button type="submit" name="updatepassbtn" class="btn btn-primary">Update Password</button>
                  <a href="ViewUsers.php" class="btn btn-danger">Cancel</a>
                </div>
              </div>

            </div>
 
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
               
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change User Profile</h6>
                </div>
           
                <div class="card-body">
               <center> <img <?php echo '<img src="../../uploads/'.$r['images'].'"width="200px;" height="200px"'; ?>  class="rounded"></center>
               <div class="form-group">
    
              <input type="file" class="form-control-file" name="user_img" value=<?php echo '<img src="../../uploads/'.$r['images'].'"width="200px;" height="200px"'; ?>>
              </div>
               <hr>
                 <button type="submit"  name="updateImgbtn" class="btn btn-primary">Change Profile Picture</button> 
                 <a href="ViewUsers.php" class="btn btn-danger">Cancel</a>
                </div>
              </div>
            </div>
          </div>
</form> 

<script>
function myFunction() {
  var x = document.getElementById("show_hide_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
 <?php include('../includes/footer.php');?>