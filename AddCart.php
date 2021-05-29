<?php
$page_title = 'Your Cart';
session_start();
include('./includes/header_Front.php');
$uu=$_SESSION['username'];
$IP=$_SESSION['IP_ADDRESS'];
?>


<div class="container">
<div class="row justify-content-center">
<div class="col-lg-10 mt-4 mb-6">
<div class="card shadow mt-4">
          
                <div class="card-body">
    
               
	<div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else {
		echo'none';	} unset($_SESSION['showAlert']);?>" class="alert alert-success alert-dismissible mt-3">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}unset($_SESSION['showAlert']);?></strong>
</div>

		<div class="table-responsive mt-2">
		
	<table class="table table-bordered table-striped text-center">
		<thead>
<tr>
	<td colspan="8" >
		<h4 class="text-center text-info">Products in Your Cart</h4>
	</td>
</tr>
<tr>
<th>#</th>
<th>ID</th>
<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th><a href="action.php?remove=all" class="badge-danger badge p-1" onclick="return confirm('Are You Sure to Delete All Cart Items ?')"><i class="fas fa-trash"></i>&nbsp; Clear All</a></th>
</tr>


</thead>
<tbody>
<?php 
//Retreiving the cart information
require('./mysqli_connect.php');	
$grandTotal=0;

$quser="SELECT user_id  FROM users where email='$uu'";
$quserrun=mysqli_query($dbc,$quser);
$uidfetch=mysqli_fetch_assoc($quserrun);
$uid=$uidfetch['user_id']; 

$q="select * from cart where uid='$uid' and IP='$IP'";
$r=@mysqli_query($dbc,$q);
if(@mysqli_num_rows($r)>0)

{
 

?>
<?php

  while($row=mysqli_fetch_assoc($r))
  {
 ?> 
<tr><td><?php echo $row['id']; ?></td>
<input type="hidden" class="uid" value="<?php echo $uid; ?>"></input>
<input type="hidden" class="piid" value="<?php echo $row['id']; ?>"></input>
<td><?php echo $row['product_id']; ?></td>
<td><?php echo '<img src="../uploads/Products/'.$row['product_image'].'"width="50px;" height="50px"'; ?></td>
<td><?php echo $row['product_name'] ?></td>
<td><i class="fas fa-dollar-sign">&nbsp;</i><?php echo $row['product_price'] ?></td>
<input type="hidden" class="pprice" value="<?php echo $row['product_price']; ?>"></input>
<td><input type="number" class="form-control itemQty" value="<?php echo $row['qty'] ?>" style="width:75px" ></input></td>
<td><i class="fas fa-dollar-sign">&nbsp;</i><?php echo $row['Total'] ?></td>
<td><a href="action.php?remove=<?php echo $row['id']; ?>" class="text-danger" onclick="return confirm('Are You Sure to Delete this Cart Item ?')"><i class="fas fa-trash-alt"></i></a></td>
</tr>
<?php $grandTotal+=$row['Total']; ?>			

<?php }?>

<tr>
	<td colspan="3">
	<a href="shop.php" class="btn btn-success"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Continue Shopping</a> 
</td>
<td colspan="3">
<b>Grand Total</b>

</td>
<td colspan="1"><i class="fas fa-dollar-sign">&nbsp;</i><b><?php echo $grandTotal; ?>
</td>	  <form action="action.php" method="post">

<input type="hidden" name="GIP" value="<?php echo $IP ?>"><br><td colspan="1">
<button type="submit" name="GuestBTN" class="btn btn-primary <?php ($grandTotal>1)?"":"disabled" ?>"><i class="fas fa-credit-card">&nbsp;&nbsp;</i>Checkout</button>

</form>

</td>
</tr>
</tbody>
  
	<?php
         }
         else{

   echo "<div class='text-center'><img src='../uploads/Site/emptyCart.gif'  class='img-fluid'></div>";

         }
        
            
        ?>
	</table>

         
        
            
     
	</div>

		</div>
                
                       </div>
                  <hr>
               
                </div>
	</div>
</div>

</div>





















<script type="text/javascript">
$(document).ready(function(){

$(".itemQty").on('change',function(){

var $el=$(this).closest('tr');
var piid=$el.find(".piid").val();
var pprice=$el.find(".pprice").val();
var qty=$el.find(".itemQty").val();

location.reload(true);
$.ajax({
  url: 'action.php',
  method:'post',
  cache:false,
  data:{qty:qty,piid:piid,pprice:pprice},
  success:function(response)
  {
	console.log(response);
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
</script></div></div></div></div>
  <!-- /.container -->

<?php include('./includes/footer-front.php');?>  