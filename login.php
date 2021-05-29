<?php
session_start();
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
$ip_address = $_SERVER['REMOTE_ADDR'];
}

$_SESSION['IP_ADDRESS']=$ip_address;
;

?>
<header>

  <link href="./includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="./includes/css/sb-admin-2.min.css" rel="stylesheet">

</header>

  <div class="container">
  <?php 
  //Shows the error and successfull messages
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
echo'<div class="alert alert-success text-center" role="alert">'.$_SESSION['success'].'</div>';
unset($_SESSION['success']);


}
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    echo'<div class="alert alert-danger text-center" role="alert">'.$_SESSION['status'].'</div>';
    unset($_SESSION['status']);     
}

?>

<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
  
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
              </div>
              <form class="user" action="./includes/login_functions.inc.php" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="logEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="logPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" name="logCheck">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                  </div>
                </div>
                <?php 

if(isset($_SESSION['statuslog']) && $_SESSION['statuslog']!='')
{
    echo'<div class="alert alert-danger" role="alert">'.$_SESSION['statuslog'].'</div>';
    unset($_SESSION['statuslog']);     
 
}

?>
        

                <button class="btn btn-primary btn-user btn-block" type="submit" name="loginbtn">
                  Login
                </button>
               
                <a href="index.php" class="btn btn-danger btn-user btn-block">
                  <i class="fas fa-home"></i> Back to Home
                </a>
                <input type="hidden" name="IP" value="<?php echo $ip_address; ?>">
              </form>
              <hr>
              <div class="text-center">
                
              </div>
              <div class="text-center">
                <a class="small" href="Register.php">Create an Account!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>