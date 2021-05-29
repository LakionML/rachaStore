<?php 
ob_start();
$page_title = 'Your Account';
session_start();
include('./includes/header_Front.php');
require('./mysqli_connect.php');	
$uu=$_SESSION['username'];
if ($uu=='Guest') {

  header('location: login.php'); exit();
}
?>
        
           
<div class="container"><h1 class="h3 mb-2 text-gray-800 mt-4">Your Details</h1>
<div class="row mt-4">

            
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
              <?php 
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Your Details</h6>
                 
                </div>
                <?php
//Selects user details

$quser="SELECT user_id  FROM users where email='$uu'";
$quserrun=mysqli_query($dbc,$quser);
$uidfetch=mysqli_fetch_assoc($quserrun);
$uid=$uidfetch['user_id']; 

//print_r($uidfetch['user_id']."dddddddddd");
//$uid=91; 
//print_r($uid."ssssssssssssssssss");
$user="SELECT `first_name`,`last_name`,`email`,`pass`,`Address`,`City`,`Mobile` FROM `users` WHERE user_id='$uid'";
$prun=mysqli_query($dbc,$user);
while ($rows=mysqli_fetch_assoc($prun)) 
{

  $fn = $rows['first_name'];
  $ln = $rows['last_name'];
  $e = $rows['email'];
  $address=$rows['Address'];
 
  $City=$rows['City'];
  $a=$rows['Mobile'];
  $mobile=(int)$a;
  $pass= $rows['pass'];
 
        ?>
                <div class="card-body">
                  <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <form action="registernew.php" method="POST" enctype="multipart/form-data" oninput='password2.setCustomValidity(password2.value != password1.value ? "Passwords do not match." : "")'>
 
              <form class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="hidden" class="form-control form-control-user" name="uid" value="<?php echo $uid; ?>">
                  
                    <input type="text" class="form-control form-control-user" name="FirstName" value="<?php echo $fn; ?>" placeholder="First Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="LastName" value="<?php echo $ln; ?>"  placeholder="Last Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" value="<?php echo $e; ?>" placeholder="Email Address" readonly>
                  <small id="emailHelp" class="form-text text-muted">You cant change your email.</small>
                </div>
                
                  <div class="form-group">
                  <textarea class="form-control"  rows="3" placeholder="Address" name="Address"  required><?php echo $address; ?></textarea>

                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="City" value="<?php echo $City; ?>" placeholder="City" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user"name="Mobile" id="onlyNumbers" name="onlyNumbers" onkeypress="return isNumber(event)" onpaste="return false;" value="  <?php echo $mobile;?>" placeholder="Mobile"required >
                  
                  </div>
                </div>
            <button class="btn btn-primary btn-user btn-block" name="updateuserbtn">Update</button>
<?php }?>  
              
                
                </div>
                </div>
              </div>
            </div>

      
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
               
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Your Profile</h6>
               
                </div>
             
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <div class="form-group">  <div class="form-group">
    
    <input type="text" hidden class="form-control"  name="edit_id">
  </div> 
  <label for="inputPassword2" class="sr-only">Password</label>
    <input type="password" name="updateinput" class="form-control" id="show_hide_password" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" onclick="myFunction()"  class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Show Password</label>
  </div>
  <hr>
 
 <button type="submit" name="updatepassbtn" class="btn btn-primary">Update Password</button>
 <a href="UserProfile.php" class="btn btn-danger">Cancel</a>    
                </div>
   </form>             
                </div>
              </div>
               </div>
            </div>  
          
          
</div>

           







</div>
</div>

 
   <script src="includes/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="includes/vendor/datatables/dataTables.bootstrap4.min.js">

$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
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


<script type="text/javascript">     
function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
</script>
<?php include('./includes/footer-front.php');?>  