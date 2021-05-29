

<?php 
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');

?>   

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Change User Details</h1>

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

<p class="mb-4">Edit Product</p>
<div class="row">
<div class="col-xl-8 col-lg-7">

     
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change Product Details</h6>
                </div>
                <div class="card-body">
                
                 
                   

 <?php
 //Selects product for editing
require	('./mysqli_connect.php');	
if (isset($_POST['editBtn'])) {
  $id=$_POST['edit_id'];
 
  $q="select * from products where product_id='$id'";
  $rows=mysqli_query($dbc,$q);
  foreach($rows as $r)
  {
 ?>


<form action="Shop.php" method="POST" enctype="multipart/form-data" >
  

   <div class="form-group">
    <label>User ID</label>
    <input type="text" hidden class="form-control" value="<?php echo $_POST['edit_id'] ?>" name="edit_id" required>
    <label><?php echo $_POST['edit_id'] ?></label>
  </div> 

   <div class="form-group">
    <label>Product Name</label>
    <input type="text" class="form-control" value="<?php echo $r['product_title'] ?>" name="pname" required>
  </div> 
  <div class="form-group">
    <label>Product Description</label>
    <input type="text" class="form-control" value="<?php echo $r['product_desc'] ?>"  name="pdesc"  required>
    </div>
  <div class="form-group">
    <label >Product Price</label>
    <input type="number" class="form-control" value="<?php echo $r['product_price'] ?>" name="pprice" aria-describedby="emailHelp" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Product Keywords</label>
    <input type="text" class="form-control" value="<?php echo $r['product_keywords'] ?>" name="pkey" aria-describedby="emailHelp" required>
    </div>
   
    <div class="form-group">
    <label >Product Category</label>
  <select class="custom-select" name="pcat" required>
    
  <?php
  $qa="select * from categories";
  $qarun=mysqli_query($dbc,$qa);
foreach($qarun as $row)
{  
 
  ?>

<option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $r['cat_id']) echo ' selected="selected"'; ?>><?php echo $row['category_name']; ?></option>


   <?php }}
    //Selects product for editing
   ?> 
   </select>
</div>


<?php }?> 

<hr>
<button type="submit" name="editDetailsBtn" class="btn btn-primary">Update</button>
<a href="Products.php" class="btn btn-danger">Cancel</a>

 </div>
</div>

          
          

            </div>
 
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
               
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Change User Profile</h6>
                </div>
           
                <div class="card-body">
               <center> <img <?php echo '<img src="../../uploads/Products/'.$r['product_img'].'"width="200px;" height="200px"'; ?>  class="rounded"></center>
               <div class="form-group">
    
              <input type="file" class="form-control-file" name="product_img" value=<?php echo '<img src="../../uploads/Products/'.$r['product_img'].'"width="200px;" height="200px"'; ?>>
              </div>
               <hr>
                 <button type="submit"  name="updateImgbtn" class="btn btn-primary">Change Profile Picture</button> 
                 <a href="Products.php" class="btn btn-danger">Cancel</a>
                </div>
              </div>
            </div>
          </div>
      
</form> 

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
 <?php include('../includes/footer.php');?>