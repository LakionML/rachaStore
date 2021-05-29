<?php 
session_start();
//include('../Security.php');

//include('./frontpage.php');
$page_title = 'Product Details';

include('./includes/header_Front.php');
include('./includes/SideBar.php');
include('./frontpage.php');
$uu=$_SESSION['username'];

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


  <div class="col-lg-9">

  <?php
//Selected product details display
$pid=$_GET['product_id'];
$products="select * from products where product_id=$pid";
$prun=mysqli_query($dbc,$products);
while ($rows=mysqli_fetch_assoc($prun)) 
{
    $pid=$rows['product_id'];
    $pname=$rows['product_title'];
    $pdesc=$rows['product_desc'];
    $pprice=number_format($rows['product_price'],2);
    $pimg=$rows['product_img'];
    
      echo "
<div class='card mt-4'>
  <img class='img-responsive' src='./../uploads/Products/$pimg' alt=''>
  <div class='card-body'>
    <h3 class='card-title'>$pname</h3>
   <h6>Product ID $pid </h6>
    <h4>$$pprice</h4>
    <p class='card-tex'>$pdesc</p>
   
    ";
}   
   
   ?>

<form action="" class="form-submit">
  <div class="form-group">
    
     <div class="form-group">

    <input type="hidden" class="qty" value="1">

  <input type="hidden" class="pid"  value="<?php echo $pid ?>">
    
       <input type="hidden" class="pname" value="<?php echo $pname ?>">
       <input type="hidden" class="pprice" value="<?php echo $pprice; ?>">
       <input type="hidden" class="pimg" value="<?php echo $pimg; ?>">
       <input type="hidden" class="user" value="<?php echo $uu; ?>">
       <input type="hidden" class="IP" value="<?php echo $ip_address; ?>">
       <button class="btn btn-primary btn-block addItemBtn"  id="AddCartbtn"><i class="fas fa-cart-plus">&nbsp;</i><span class='text'> Add Cart</span></button>    
</div>
</form>
<div id="message" class="mt-3" >
  
  </div>

<div class="row mb-4">
</div><div class="row mb-4">
</div>
  </div>
</div>


</div>
<!-- /.col-lg-9 -->

</div>


   
   
   
   
   
   
   
   
   
 

 

  </div>
  <!-- /.row -->

</div>
<!-- /.col-lg-9 -->

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
      var IP=$form.find(".IP").val();
      
      $.ajax({
      url: 'action.php',
      method: 'post',
      data:{pid:pid,pname:pname,pprice:pprice,qty:qty,pimg:pimg,IP:IP},
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










<?php include('./includes/footer-front.php');?>  