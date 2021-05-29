<?php 
    $page_title = 'My Order Details';
    ob_start();
    session_start();
    include('./includes/header_Front.php');
    require('./mysqli_connect.php');	
    $uu=$_SESSION['username'];
    $quser="SELECT user_id  FROM users where email='$uu'";
    $quserrun=mysqli_query($dbc,$quser);
    $uidfetch=mysqli_fetch_assoc($quserrun);
    $uid=$uidfetch['user_id']; 
    if ($uu=='Guest') {

      header('location: login.php'); exit();
    }
?>
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
         
      
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800 mt-4">Order Detail</h1>           
</div>
<div class="container">

<div class="card">
  <div class="card-header">
  Order Details
  </div>
  <div class="card-body">
 
  <table class="table table-bordered" id="dataTable" cellspacing="0">
                      
                      <thead>
                          <tr>
                              <th>Order ID</th>
                              <th>Order Date</th>
                              <th>Order Status</th>
                              <th>Payment Type</th>                      
                              <th>Total</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr> <?php 
    
          //Customer order history
           $q="SELECT orders.id as id,order_status.name,orders.payment_type as payment_type,orders.total_price as total_price,orders.payment_status,orders.added_on as added_on FROM orders LEFT JOIN (order_status)
           ON (orders.order_status =order_status.id ) WHERE orders.user_id='$uid'";
         
             $r=@mysqli_query($dbc,$q);
             if(@mysqli_num_rows($r)>0)
              
              {
            
    
              while($rows=mysqli_fetch_assoc($r))
              {
               ?>
                              <td><?php echo $rows['id'] ?></td>
                              <td><?php echo $rows['added_on'] ?></td>
                              <td><?php echo $rows['name'] ?></td>
                              <td><?php echo $rows['payment_type'] ?></td>
                              <td><?php echo $rows['total_price'] ?></td>
                              <th><a href="OrderDetails.php?order_id=<?php echo $rows['id'] ?>" class="btn btn-primary btn-sm">View Details</a></th>
                             
                          </tr>
                         <?php }?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>Order ID</th>
                              <th>Order Date</th>
                              <th>Order Status</th>
                              <th>Payment Type</th>                      
                              <th>Total</th>
                              <th>Action</th>
                          </tr>   
                      </tfoot> <?php
            }
             else{
    
    
    echo '
    <div class="alert alert-warning" role="alert">
    You have no Orders Yet, Lets buy something.
    </div>';
    echo "<div class='text-center'><img src='../uploads/Site/emptyCart.gif'  class='img-fluid'></div>";
             }
            
                
            ?>

    </table>
                   
    </div></div>
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