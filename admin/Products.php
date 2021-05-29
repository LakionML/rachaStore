<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');



?>   
  

<div class="modal fade" id="NewProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

        <form action="Shop.php" method="POST" enctype="multipart/form-data")'>
          <div class="form-group">
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="product_name" required>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Product Description</label>
            <textarea class="form-control" name="product_Desc"  rows="3"></textarea>
          </div>
          <div class="form-group">
          <div class="form-group">
            <label>Product Price</label>
            <input type="number" class="form-control" name="product_price" required>
          </div>
          </div>
          <div class="form-group">
            <label>Product Keywords</label>
            <input type="text" class="form-control" name="product_keys"  required>
          </div>
        
        <?php
        require ('./mysqli_connect.php');

        $cate="select * from categories";
        //$cate="select * from user_roles";
        $r=mysqli_query($dbc,$cate);
        if (mysqli_num_rows($r)) {
        ?>
          <div class="form-group">
            <label >Choose Product Category</label>
            <select value="" id="pcat" name="pcat" class="form-control" required>
              
            <?php
            foreach($r as $row)
            { 
                
                echo $row['category_name'];
            ?>
            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
          <?php
          }
          ?>
          </select>
        </div>
        <?php 
        }
        else {
            
            echo '<h1>No Records</h1>';
        
        } 
        ?>

          <div class="form-group">
          <div class="custom-file">
            <input type="file" name="product_img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
            <label class="custom-file-label" for="inputGroupFile01">Product Picture</label>
          
          </div>
          
          </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="newprobtn">Add Product</button>
              
              </div>
            
        </form>
            </div>
          </div>
        </div>
</div>

<div class="container-fluid"> 
  <h1 class="h3 mb-2 text-gray-800">Products</h1>  <p class="mb-4">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NewProductModal">
  Add New Product
</button></div>   
<div class="card shadow mb-4">
            <div class="card-header py-3">


     
            

                    <?php
                    //Shows the error and successfull messages 
if(isset($_SESSION['success']) && $_SESSION['success']!='')
{
echo'<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
unset($_SESSION['success']);

}
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
    echo'<div class="alert alert-danger" role="alert">'.$_SESSION['status'].'</div>';
    unset($_SESSION['status']);     
}
//Shows the error and successfull messages
?>

           </div>    
              
           <div class="card-body">
        
           <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?php 
   //retreives all the product information       
  //require	('./mysqli_connect.php');	
            $q="select * from products";
            $r=@mysqli_query($dbc,$q);
            if(@mysqli_num_rows($r)>0)
            
            {
             
           
            ?>
  <thead>
    <tr>
      <th>#</th>
      <th>Image</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Product Description</th>
      <th>Price</th>
      <th>Keywords</th>
      <th>Added Date</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
 <tr>
 <th>#</th>
      <th>Image</th>
      <th>Product Name</th>
      <th>Category</th>
      <th>Product Description</th>
      <th>Price</th>
      <th>Keywords</th>
      <th>Added Date</th>
      <th></th>
    </tr>
  <tbody>
<?php

while($row=mysqli_fetch_assoc($r))
{

$catID=$row['cat_id'] ;
$cat="select * from categories where category_id='$catID'";
$carrun=mysqli_query($dbc,$cat);

 ?>
 

    <tr>
          <td><?php echo $row['product_id'] ?></td>
          <td><?php echo '<img src="../../uploads/Products/'.$row['product_img'].'"width="50px;" height="50px"'; ?></td>
          <td><?php echo $row['product_title'] ?></td>
          <td><?php echo $row['cat_id']."   " ?><?php foreach ($carrun as $dpt_row) { echo $dpt_row['category_name'];
} ?></td>



          <td><?php echo $row['product_desc'] ?></td>
          <td><?php echo $row['product_price'] ?></td>
          <td><?php echo $row['product_keywords'] ?></td>
          <td><?php echo $row['date'] ?></td>
          <td>  <div class="btn-group" role="group" aria-label="First group">
 
          <form action="EditProducts.php" method="post">               
  <input type="hidden" name="edit_id" value="<?php echo $row['product_id'];?>">
  <button type="submit" name="editBtn"   class="btn btn-success">Edit</button> 
  
  </form>
  <form action="Shop.php" method="post">   
                <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>">
                <input type="hidden" name="delname" value="<?php echo $row['product_title'];?>">
                <button type="submit"  name="DeleteProBtn"  class="btn btn-danger" onclick="return confirm('Are You Sure to Delete this <?php echo $row['product_title'] ?> ?')">Delete</button>
           </form>
  




  </div></td>
    </tr>
       <?php 
}

?>
  </tbody>
</table>     
        <?php
        	mysqli_close($dbc);
         }
         else{

echo "no records found";

         }
        
        //retreives all the product information    
        ?>

</div> 

</div> 



 <?php 

include('../includes/footer.php');
?>