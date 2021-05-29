<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');





?>  

 
<div class="modal fade" id="NewCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
            
              <form action="Shop.php" method="POST">
          <div class="form-group">
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" name="Cat_name"  required>
            </div>
          </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="newCatbtn">Save changes</button>
              
              </div></form>
            </div>
          </div>
          </div>
        </div>







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



      
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Categories</h1>           
</div>



<div class="card shadow">

          <div class="card-header py-3">  
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NewCatModal">
  Add New Category
   </button>
          <table class="table">

          <?php 
          //retreive data from Categories table
          require	('./mysqli_connect.php');	
          $q="select * from categories";
          $r=@mysqli_query($dbc,$q);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
     
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   <?php

   while($row=mysqli_fetch_assoc($r))
  {
 ?>
 

    <tr>
          <td><?php echo $row['category_id'] ?></td>
          <td><?php echo $row['category_name'] ?></td>
     
  <td>  <div class="btn-group" role="group" aria-label="First group">
          <form action="CategoryEdit.php" method="POST">    
                <input type="hidden" name="edit_id" value="<?php echo $row['category_id'];?>">
                <button type="submit" name="CateditBtn" class="btn btn-success">Edit</button> 
                </form>
                <form action="Register.php" method="post">   
                <input type="hidden" name="deletecat_id" value="<?php echo $row['category_id'];?>">
                <button type="submit"  name="DeleteCatBtn"  class="btn btn-danger" onclick="return confirm('Are You Sure to Delete this <?php echo $row['category_id'] ?> ?')">Delete</button>
           </form>

             
           



          

          </div>
  </td>
    </tr>
      









      <?php }?>
  </tbody>
 </table> 
           






    <?php
         }
         else{

   echo "no records found";

         }
        //retreive data from Categories table
            
        ?>

          </div>




          





</div>








<?php include('../includes/footer.php');?>