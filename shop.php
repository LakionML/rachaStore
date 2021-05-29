<?php 
$page_title = 'Shop';
session_start();
//require('./mysqli_connect.php');	
//<div id="message" >

include('./includes/header_Front.php');
include('./includes/SideBar.php');
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

<div class="col-lg-9" style="margin-bottom: 60px">
<?php


?>
  <div id="message" class="mt-3" >
  
  </div>
  <h1 style="margin-top:25px "> Shop Page</h1>
  <div class="row">

   <?php
   //Get the list of products
 if (isset($_GET['catid'])) {
   $catids= $_GET['catid'];
   
    $products="select * from products WHERE cat_id='$catids'";
}
elseif (isset($_GET['pfo'])) {
  $pfo= $_GET['pfo'];
  $pto= $_GET['pto'];
 // SELECT job FROM mytable WHERE id BETWEEN 10 AND 15
  $products="select * from products WHERE product_price BETWEEN '$pfo' AND '$pto'";


}
else
{
    $products="select * from products";

}

$prun=mysqli_query($dbc,$products);
if(@mysqli_num_rows($prun)>0)
            
{
 


while ($rows=mysqli_fetch_assoc($prun)) 
{
  
    $pid=$rows['product_id'];
    $pname=$rows['product_title'];
    $pdesc=$rows['product_desc'];
    $pprice=number_format($rows['product_price'],2);
    $pimg=$rows['product_img'];
  ?>
    
    <div class='col-lg-4 col-md-6 mb-4'>
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
       <input type="hidden" class="user" value="<?php echo $uu; ?>">
       <input type="hidden" class="IP" value="<?php echo $ip_address; ?>">

    
       <div class="row">
    <div class="col">   <button class="btn btn-primary btn-block addItemBtn"  id="AddCartbtn"><i class="fas fa-cart-plus">&nbsp;</i><span class='text'> Add Cart</span></button>
    
  </div></form> 
  
  
  </div>

   

   </form>
 
      

       
      </div>
    </div>
    </div>
    

     
    
 <?php 
}   
   
   ?>

<?php
         }
         else{

echo '<div class="row justify-content-center">
<div class="col"><div class="alert alert-warning" role="alert">
There are no products on this category, We will add items soon.
</div></div></div>';

         }
        
            
        ?>

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


</div>









<?php include('./includes/footer-front.php');?>  