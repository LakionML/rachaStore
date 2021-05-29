<?php 
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');
require	('./mysqli_connect.php');	 
?>

    
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
             </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                       //Count of all the products available on the website
                       $q="SELECT product_id FROM `products`";
                       $r=mysqli_query($dbc,$q);
                       $row=mysqli_num_rows($r);
                       echo $row;
                       //Count of all the products available on the website
                       ?>
                  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      $ <?php 
                       //Sum of sold products available on the website
                       $q="   SELECT SUM(order_detail.price) as tot
                       FROM order_detail
                       INNER JOIN orders
                       on order_detail.id=orders.id";
                       $r=mysqli_query($dbc,$q);
                       while($ra = mysqli_fetch_array($r)){
                       echo $ra['tot'];}
                       //Sum of sold products available on the website 
                       ?>
                      
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger  shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Users</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                       //Number of available users
                        $q="SELECT user_id FROM `users`";
                        $r=mysqli_query($dbc,$q);
                        $row=mysqli_num_rows($r);
                        echo $row;
                        //Number of available users
                        ?></div>
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Forum Posts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                       //Total number of posts
                        $q="SELECT * FROM `messages`";
                        $r=mysqli_query($dbc,$q);
                        $row=mysqli_num_rows($r);
                        echo $row;
                        //Total number of posts
                        ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Recent Sales</h6>
             </div>
                <!-- Card Body -->
     
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
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 
                    //Retreiving Order detail table

	
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
         //Retreiving Order detail table
            
        ?>
                  </tbody>
                </table>






                
           
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

        

      
      

      <?php 

include('../includes/footer.php');
?>
