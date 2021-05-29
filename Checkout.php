<?php
ob_start();
$page_title = 'Checkout';
session_start();
include('./includes/header_Front.php');
$grand_total=0;
$uu=$_SESSION['username'];



?>


<div class="container">
<div class="row justify-content-center">
	<div class="col-lg-5">
    <h2 class="text-center text-info p-2">Complete Your Order!</h2>
    
    <div class="jumbotron p-3 mb-2 text-center">

    <h6 class="lead">Products :</h6>
    <div class="table">
    <table class="table table-borderless text-left" >
		<thead>
<thead>
<tr>
<th>Product</th>
<th>Qty</th>
<th>Total</th>

</tr>
</thead>
<tbody>
<?php
//Retreiving the checkout details
require('./mysqli_connect.php');

$quser="SELECT user_id  FROM users where email='$uu'";
$quserrun=mysqli_query($dbc,$quser);
$uidfetch=mysqli_fetch_assoc($quserrun);
$uid=$uidfetch['user_id']; 

$totq="SELECT * FROM `cart` where uid='$uid'";
$r=@mysqli_query($dbc,$totq);
if (mysqli_num_rows($r)==0) {

    header('location: AddCart.php'); exit();
}
else{
while($row=mysqli_fetch_assoc($r))
{

$grand_total+=$row['Total'];
$itemname=$row['product_name'];
$items=$row['qty'];
$cost=$row['product_price'];
$sub=($cost*$items);
?>
    <tr>
        <td> <?php echo $itemname;  ?></td>
        <td> <?php echo $items;  ?></td>
        <td> <i class="fas fa-dollar-sign">&nbsp;</i><?php echo $sub;  ?></td><?php }} ?>
    </tr><hr>
<tr>
    
    <td colspan="2" class="text-right"><b>Grand Total:</b></td>
    <td colspan="3" class="text-left"><b><i class="fas fa-dollar-sign">&nbsp;</i><?php echo $grand_total;  ?></b>
    </td>
</tr>
<tr>
    <td colspan="3" class="text-right">
    <form action="action.php" method="POST")>
    <input type="hidden" name="cuid"  value="<?php echo $uid ?>">
    <input type="hidden" name="total"  value="<?php echo $grand_total ?>">
    <div class="form-group">
    <label class="text-left">Select The Payment Method</label>
    <select class="form-control" id="exampleFormControlSelect1" name="paymethod">
      <option selected>Credit Card</option>
      <option>Band Transfer</option>
      <option>Cash On Delivery</option>
    </select>
  </div>
    <button type="submit" name="paynowbtn" class="btn btn-primary btn-block" ><i class="fas fa-credit-card">&nbsp;&nbsp;</i>Pay Now</button>
    </form>

      
</td>
</tr>
</tbody>

</table>

</div>
    </div>
</div>
</div>


















<script type="text/javascript">
$(document).ready(function(){
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
</div></div></div>
<?php include('./includes/footer-front.php');?>  