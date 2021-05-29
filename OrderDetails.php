<?php 
ob_start();
$page_title = 'My Order Details';
session_start();
include('./includes/header_Front.php');
require('./mysqli_connect.php');	
$uu=$_SESSION['username'];
$quser="SELECT user_id  FROM users where email='$uu'";
$quserrun=mysqli_query($dbc,$quser);
$uidfetch=mysqli_fetch_assoc($quserrun);
$uid=$uidfetch['user_id']; 
$oid=$_GET['order_id'];
if ($uu=='Guest') {

  header('location: login.php'); exit();
}
?>
        
           
<div class="container">
<div class="row mt-4">
 <div class="container mb-5">
         
      
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Order No: <?php echo $oid; ?></h1>           
</div>


<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Your Purchase History</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Qty</th>
                      <th>Total</th>
                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Qty</th>
                      <th>Total</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                    <?php 

          //Customer order details
          $q="SELECT
          products.product_id AS product_id,
          products.product_title AS product_title,
          order_detail.price AS price,
          order_detail.qty AS qty,
          price*qty as total
      FROM
          `order_detail`
      INNER JOIN products ON products.product_id = order_detail.product_id
      WHERE order_detail.order_id='$oid'";
          $r=@mysqli_query($dbc,$q);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
         
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
         <td><?php echo $row['product_id'] ?></td>
          <td><?php echo $row['product_title'] ?></td>

          <td><?php echo '$ '.$row['price'] ?></td>
          <td><?php echo  $row['qty'] ?></td>
          <td><?php echo '$ '.$row['total'] ?></td>











                    </tr>
                    <?php 
}

?>
  </tbody>



  
</table>    
<?php
        }
         else{


echo '<div class="row justify-content-center">
<div class="col"><div class="alert alert-warning" role="alert">
You have no Orders Yet, Lets buy something.
</div></div></div>';
         }
        
            
        ?>
            
  













 
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
</script></div></div></div></div></div>


</div>
   </div>
   </div>
   </div>
<?php include('./includes/footer-front.php');?>  