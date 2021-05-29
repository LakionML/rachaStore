<?php
ob_start();
$page_title = 'Checkout';
session_start();
include('./includes/header_Front.php');
if (empty ($_SESSION['sucssess'])) {

    header('location: AddCart.php'); exit();
}

?>
<div class="container">
<div class="row justify-content-center">

 <img src="../uploads/Site/payment.gif" class="img-responsive"> 
</div>

<div class="row justify-content-center">
<?php
if(isset($_SESSION['sucssess']) && $_SESSION['sucssess']!='')
{
echo'<div class="alert alert-success" role="alert"><h1>'.$_SESSION['sucssess'].'</h1></div>';
unset($_SESSION['sucssess']);


}

?>
<a href="index.php" class="btn btn-primary btn-user btn-block">
                  <i class="fas fa-home"></i> Back to Home
                </a>
</div></div>















</div>
</div>



<?php include('./includes/footer-front.php');?>  