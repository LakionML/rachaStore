
<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');



?>   


<!--Carries the delete user details to Bootstrap model-->
<script type="text/javascript">
$(document).ready(function(){
$('.deletebtn').on('click',function()
{
$('#DeleteUserModal').modal('show');

$tr=$(this).closest('tr');
var data=$tr.children("td").map(function(){
return $(this).text();

}).get();
console.log(data);
$('#delete_id').val(data[0]);
$('#delete_name').val(data[2]);
});
});


 </script>







 <div class="modal fade" id="NewUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       </div>
      <div class="modal-body">





      <form action="Register.php" method="POST" enctype="multipart/form-data" oninput='password2.setCustomValidity(password2.value != password1.value ? "Passwords do not match." : "")'>
  <div class="form-group">
   <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="first_name" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="last_name"  required>
  </div>

    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
      
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password1" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="password2" required>
  </div><div class="form-group">
    <label >Choose User Type</label>
  <select class="custom-select" name="usertype" required>
     <option value="1">Admin</option>
    <option value="2"selected>Staff</option>
    <option value="3">Customer</option>
  </select></div>
  <div class="form-group">
   <div class="custom-file">
    <input type="file" name="user_img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
    <label class="custom-file-label" for="inputGroupFile01">Select User Avatar</label>
    <div class="invalid-feedback">
      <? echo$nameimgErrs; ?>
    </div>
  </div>
  
   </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="newuserbtn">Save changes</button>
       
      </div>
    
    </form>
    </div>
  </div>
</div>
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Users</h1>
          <p class="mb-4"><?php 

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

?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NewUserModal">
  Add New User
</button>
           </div>    </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Current Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Avatar</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Registered Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>User ID</th>
                      <th>Avatar</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Registered Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 
//Displays all avaialble users
require('./mysqli_connect.php');	
          $q="select * from users";
          $r=@mysqli_query($dbc,$q);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
         <td><?php echo $row['user_id'] ?></td>
         <td><?php echo '<img src="../../uploads/'.$row['images'].'"width="50px;" height="50px"'; ?></td>
          <td><?php echo $row['first_name'] ?></td>
          <td><?php echo $row['last_name'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['role_id'] ?></td>

          <td><?php echo $row['registration_date'] ?></td>

          <td>  <div class="btn-group" role="group" aria-label="First group">
  <form action="EditUser.php" method="post">               
  <input type="hidden" name="edit_id" value="<?php echo $row['user_id'];?>">
  <button type="submit" name="editBtn"   class="btn btn-success">Edit</button> 
  
  </form>
  <form action="Register.php" method="post">  
  
  <input type="hidden" name="removeid" value="<?php echo $row['user_id'];?>">
<button class="btn btn-danger" name="delbtn" data-href="Register.php?remove=<?php echo $row['user_id'] ?>" onclick="return confirm('Are You Sure to Delete this <?php echo $row['first_name'] ?> ?')">
Delete
</button>

</form>
</td>









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