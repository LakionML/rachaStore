<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');



?>   

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Orders</h1>
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer</th>
                      <th>Order Date</th>
                      <th>Order Status</th>
                      <th>Payment Type</th>
                      <th>Payment Status</th>
                      <th>Amount</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>#</th>
                      <th>Customer</th>
                      <th>Order Date</th>
                      <th>Order Status</th>
                      <th>Payment Type</th>
                      <th>Payment Status</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 
                    //Retreiving the order details from Order details from order+customer details+order status

require('./mysqli_connect.php');	
          $q="

          SELECT orders.added_on AS added_on, orders.payment_status AS payment_status, orders.payment_type AS payment_type, orders.total_price AS total_price, order_status.name AS order_status, users.first_name AS first_name, users.last_name AS last_name, orders.id AS id FROM ( ( orders INNER JOIN users ON orders.user_id = users.user_id ) INNER JOIN order_status ON orders.order_status = order_status.id ) ORDER BY orders.added_on DESC";
          $r=@mysqli_query($dbc,$q);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
         <td><?php echo $row['id'] ?></td>
       
          <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
          <td><?php echo $row['added_on'] ?></td>
          <td><?php echo $row['order_status'] ?></td>
          <td><?php echo $row['payment_type'] ?></td>
          <td><?php echo $row['payment_status'] ?></td>
          <td class="text-right"><?php echo '$ '. $row['total_price'] ?></td>

          <td>  <div class="btn-group" role="group" aria-label="First group">
 
 <form action="EditOrder.php" method="post">               
<input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
<input type="hidden" name="os" value="<?php echo $row['order_status'];?>">
<button type="submit" name="editBtn"   class="btn btn-success">Edit</button> 

</form>






</div></td>

                              </tr>
                    <?php 
}

?>
  </tbody>



  
</table>     
        <?php
         }
         else{

echo "no records found";

         }
        
        //Retreiving the order details from Order details from order+customer details+order status   
        ?>
                  </tbody>
                </table>






                
           
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
       

        

      
      

      <?php 

include('../includes/footer.php');
?>
