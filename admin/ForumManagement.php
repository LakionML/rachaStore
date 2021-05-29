
<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');



?>   




        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Forum Posts</h1>
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
//Shows the error and successfull messages
?>

           </div>    </p>

          <!-- DataTables Current Posts -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Current Posts</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User ID</th>
                   
                      <th>Last Name</th>
                      <th>Tropic</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Posted Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>#</th>
                      <th>User ID</th>
                      <th>First Name</th>
                  
                      <th>Tropic</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Posted Date</th>
                      
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 
// Capture All Messages written by Users 
require('./mysqli_connect.php');	
          $q="SELECT messages.message_id as mid,messages.user_id as uid,users.first_name as first_name,users.last_name as last_name,messages.tropic as tropic, messages.subject as subject,messages.message as message,messages.date as date FROM messages INNER JOIN users ON users.user_id=messages.user_id";
          $r=@mysqli_query($dbc,$q);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
         <td><?php echo $row['mid'] ?></td>
         <td><?php echo $row['uid'] ?></td>
          <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
          <td><?php echo $row['tropic'] ?></td>
          <td><?php echo $row['subject'] ?></td>
          <td><?php echo $row['message'] ?></td>

          <td><?php echo $row['date'] ?></td>

          <td>  <div class="btn-group" role="group" aria-label="First group">
          <form action="ForumComments.php" method="post">  
  
  <input type="hidden" name="viewpostid" value="<?php echo $row['mid'];?>">
<button class="btn btn-success" name="viewPost" type="submit">view</button>

</form>
  <form action="Register.php" method="post">  
  
  <input type="hidden" name="removepostid" value="<?php echo $row['mid'];?>">
<button class="btn btn-danger" name="DelPost" data-href="Register.php?remove=<?php echo $row['mid'] ?>" onclick="return confirm('Are You Sure to Delete this tropic <?php echo $row['tropic'] ?> and its comments?')">
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

echo "no Forum Posts found";

         }
        // Capture All Messages written by Users 
            
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