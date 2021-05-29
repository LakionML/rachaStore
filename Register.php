<?php
$page_title = 'Register';
session_start();
include('./includes/header_Front.php');


?>
 
  
 


<div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        <div class="col-md-5 mt-5">
            <img class="media" style="width: 500px; height: 500px;" src="../uploads/Site/register.jpg" data-holder-rendered="true">
          </div>
          <div class="col-md-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              
<form action="registernew.php" method="POST" enctype="multipart/form-data" oninput='password2.setCustomValidity(password2.value != password1.value ? "Passwords do not match." : "")'>
 
              <form class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="FirstName" placeholder="First Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="LastName"  placeholder="Last Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" pattern=".{8,}" name="password1" placeholder="Password (Minimum length 8)" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user"pattern=".{8,}" name="password2"  placeholder="Repeat Password (Minimum length 8)" required>
                  </div></div>
                  <div class="form-group">
                  <textarea class="form-control"  rows="3" placeholder="Address" name="Address" required></textarea>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="City" placeholder="City" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user"name="Mobile"  placeholder="Mobile "required >
                  </div>
                </div>
            <button class="btn btn-primary btn-user btn-block" name="newuserbtn">Register Account</button>
                
              </form>                <?php 
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
echo'<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
unset($_SESSION['success']);


}
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    echo'<div class="alert alert-danger" role="alert">'.$_SESSION['status'].'</div>';
    unset($_SESSION['status']);     
}

?>
    
                <hr>
             
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>

          
        </div>
      </div>
      </div> </div>
      <?php include('./includes/footer-front.php');?>  