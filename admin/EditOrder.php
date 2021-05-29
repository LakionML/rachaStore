
<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');

$oid=$_POST['edit_id'];

?>   












        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Order No: <?php echo $_POST['edit_id'] ?></h1>
          <p class="mb-4"><?php 
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
echo'<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
unset($_SESSION['success']);

}
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    echo'<div class="alert alert-danger" role="alert">'.$_SESSION['status'].'</div>';
    unset($_SESSION['status']);     
}

?>

           </div>    </p>

          <!-- DataTables -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Order Details </h6>
              <h6 class="m-0 font-weight-bold text-primary">Order Status: <?php 
              
              if ($_POST['os']=="Success") {
                 echo 'Success';
              }
              else{

                echo $_POST['os']."  " .'<a class="btn btn-success" href="Register.php?done='.$oid.'" role="button">Mark As Done</a>';

              }?>
             </h6>


            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
//Retreiving data from the Order details
require('./mysqli_connect.php');	
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
//Retreiving data from the Order details
?>
  </tbody>



  
</table>     
        <?php
         }
         else{

echo "no records found";

         }
        
            
        ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>



  <?php include('../includes/footer.php');?>  