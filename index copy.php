<?php 
    session_start();
    $page_title = 'Home';
  //include('./includes/header_Front.php');
    require('./mysqli_connect.php');	
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
                      
<?php 



}?>
                       
</li>

            
            
       
 
        </a>
        
  
<li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="username"> 
            <?php echo $_SESSION['username'] ??$_SESSION['username']='Guest'; $uu=$_SESSION['username'];?></span> 
      
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


<script type="text/javascript">
      $(document).ready(function(){
      $(".addItemBtn").click(function(e){
      e.preventDefault();
      var $form=$(this).closest(".form-submit");
      var pid=$form.find(".pid").val();
      var qty=$form.find(".qty").val();
      var pname=$form.find(".pname").val();
      var pprice=$form.find(".pprice").val();
      var pimg=$form.find(".pimg").val();
      
      $.ajax({
      url: 'action.php',
      method: 'post',
      data:{pid:pid,pname:pname,pprice:pprice,qty:qty,pimg:pimg},
      success:function(response){
      $("#message").html(response);
      load_cart_item_number(); 
      }

      });     

      });
      load_cart_item_number();
      function load_cart_item_number(){
      $.ajax({
        url: 'action.php',
        method:'get',
        data:{cartItem:"cart_item"},
        success:function(response){

      $("#cart-item").html(response);   

        }
      })

      }

      });
</script>


<header>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../uploads/Site/2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../uploads/Site/3.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../uploads/Site/2.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  </header>








<!-- Page Content -->
<div class="container">

<h1 class="my-4 text-center">Our Trends</h1>
<div id="message" ></div>
<!-- Marketing Icons Section -->
<div class="row">

<?php


$products="select * from products order by 1 DESC LIMIT 0,3";
$prun=mysqli_query($dbc,$products);
while ($rows=mysqli_fetch_assoc($prun)) 
{
  
    $pid=$rows['product_id'];
    $pname=$rows['product_title'];
    $pdesc=$rows['product_desc'];
    $pprice=number_format($rows['product_price'],2);
    $pimg=$rows['product_img'];
  ?>
    
    

      <div class='col-lg-4 mb-4'>
      <div class='card h-100'>

      <a href='ProductDetails.php?product_id=<?php echo $pid ?>'><img class='card-img-top' src='./../uploads/Products/<?php echo $pimg ?>' alt=''></a>
      <div class='card-body'>
        <h4 class='card-title'>
          <a href='ProductDetails.php?product_id=<?php echo $pid ?>'><?php echo $pname ?></a>
        </h4>
        <h5>$<?php echo $pprice ?></h5>
        <p class='card-text'><?php echo $pdesc ?></p>
      </div>
      <div class='card-footer'>
      <form action="" class="form-submit">
      <input type="hidden" class="pid"  value="<?php echo $pid ?>">
      <input type="hidden" class="qty"  value="1">
       <input type="hidden" class="pname" value="<?php echo $pname ?>">
       <input type="hidden" class="pprice" value="<?php echo $pprice; ?>">
       <input type="hidden" class="pimg" value="<?php echo $pimg; ?>">
       <button class="btn btn-primary btn-block addItemBtn" <?php if ($uu=='Guest') {echo 'disabled data-toggle="tooltip" data-placement="top" title="First You Neet To Login or create Account"';}else{  echo '';} ?> id="AddCartbtn"><i class="fas fa-cart-plus">&nbsp;</i><span class='text'> Add Cart</span></button>
    

   </form>
 
      

       
      </div>
    </div>
    </div>
   
 <?php 
}   
   
   ?>
</div>
<!-- /.row -->

<!-- Portfolio Section -->
<h2>Accessories</h2>

<div class="row align-items-stretch">
          <div class="col-lg-8">
            <div class="product-item sm-height full-height bg-gray">
            <a href="Shop.php">
              <img src="../uploads/Site/img1.jpg" alt="Men Clothing"  class="img-fluid"></a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="product-item sm-height bg-gray mb-4">
              <a href="Shop.php">
              <img src="../uploads/Site/img2.jpg" alt="Image" class="img-fluid" ></a>
            </div>

            <div class="product-item sm-height bg-gray mb-4">
            <a href="Shop.php">
              <img src="../uploads/Site/img3.jpg" alt="Image" class="img-fluid"></a>
            </div>

            <div class="product-item sm-height bg-gray mb-4">
            <a href="Shop.php">
              <img src="../uploads/Site/img4.jpg" alt="Image" class="img-fluid"></a>
            </div>


          </div>
        </div>


<hr>

<!-- Call to Action Section -->
<div class="row mb-4 mb-6" style="height: 200px">
  <div class="col-md-8">
    <h1><p>We are Trend Setters not the Followers!</p></h1>
  </div>
  <div class="col">
    <a class="btn btn-lg btn-secondary btn-block" href="Shop.php">Click to customize yourself</a>
  </div>
</div>

</div>

<?php include('./includes/footer-front.php');?>  