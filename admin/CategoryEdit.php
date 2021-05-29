<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');
?>   
     
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Category Edit</h1>       
  
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


<div class="card shadow mb-4">
               
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                  </div>
              
                <div class="card-body">
       
 



              <div class="form-group">
                <label>Category ID</label>
                <input type="text" hidden class="form-control" name="edit_id" required>
                <label><?php echo $_POST['edit_id'] ?></label>
              </div> 

        

            <?php
            //Selects perticular category for editing
              require	('./mysqli_connect.php');	
              if (isset($_POST['CateditBtn'])) {
                $id=$_POST['edit_id'];
              
                $q="select * from categories where category_id='$id'";
                $rows=mysqli_query($dbc,$q);
                foreach($rows as $r)
                {
            ?>
 <form action="Shop.php" method="POST" >
 <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
    <input type="text" hidden class="form-control" name="edit_id" value="<?php echo $_POST['edit_id'] ?>" >
    <input type="text" class="form-control" value="<?php echo $r['category_name'] ?>" name="updateCatName" required>
    </div>
  </div>






          <?php   } }
          //Selects perticular category for editing
          ?> 
                          <hr>
                
                <button type="submit" name="updateCatbtn" class="btn btn-primary">Update Category</button>

                <a href="Categories.php" class="btn btn-danger">Cancel</a>
              
  </form>
           


 </div>
</div>







<?php include('../includes/footer.php');?>