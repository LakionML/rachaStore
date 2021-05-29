<?php


{

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
	<title><?php	echo	$page_title;	?></title>
 


  <link href="includes/css/bootstrap.min.css" rel="stylesheet">
  <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="includes/css/Shop-homepage.css" rel="stylesheet">
  <script src="includes/vendor/jquery/jquery.min.js"></script>
  <script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="includes/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="includes/js/sb-admin-2.min.js"></script>
 
 
  <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  


  <link href="includes/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
  


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary fixed-top">
    <div class="container">
    <div class="logo">
                                     <a href="index.php"><img src="../uploads/Site/4.png" alt="logo images"></a>
                                </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if($page_title=='Home'){echo "active";}else{echo "";} ?>" >
          
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item <?php if($page_title=='Shop'){echo "active";}else{echo "";} ?>">
            <a class="nav-link" href="Shop.php">Shop</a>
          </li>
          <li class="nav-item <?php if($page_title=='About Us'){echo "active";}else{echo "";} ?>"  >
            <a class="nav-link" href="about.php">About Us</a>
          </li>
       
          <li class="nav-item <?php if($page_title=='Contact Us'){echo "active";}else{echo "";} ?>">
            <a class="nav-link" href="contactUs.php">Contact Us</a>
          </li>
          <li class="nav-item <?php if($page_title=='Forum'){echo "active";}else{echo "";} ?>">
            <a class="nav-link" href="Forum.php">Forum</a>
          </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
         
    
<li>

                    <a href="AddCart.php" class="btn btn-light btn-icon-split" ><i class="fa" style="font-size:20px">&#xf07a;</i> Cart
                       <span id="cart-item" class="badge badge-danger"></span></a>
                      
<?php }?>
                       
</li>

            
            
       
 
        </a>
        
  
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="username"> 
            <?php echo $_SESSION['username'] ??$_SESSION['username']='Guest';?></span> 
      
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          
         <?php
         if ($_SESSION['username']=='Guest')
          {
              echo '
              
              <a class="dropdown-item" href="Register.php">
                <i class="fas fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                Register
              </a>
              
              <a class="dropdown-item" href="login.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Login
            </a>
              
              ';
          }
          else {

              echo '
          
              
              <a class="dropdown-item" href="UserProfile.php?userName='.$_SESSION['username'].'">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="YourPosts.php">
            <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            My Posts
          </a>
              
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>';
          }
         
         
         ?>
         
        </div>
      </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <form action="logout.php" method="POST">
          <button type="submit" name="logoutbtn" class="btn btn-primary">Logout</a>
         </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Page Content -->
  <div class="container">
  <div class="row">

       