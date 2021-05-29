
<?php 
//session_start();
include('../Security.php');
include('../includes/header.php');
include('../includes/menubar.php');
require('./mysqli_connect.php');
//Retreive comments related to the selected post	
if(isset($_POST['viewPost']))
{

     
      $viewpostid=$_POST['viewpostid'];

      
          if($viewpostid>0){
        
            $q="SELECT * FROM posts INNER JOIN messages on messages.message_id='$viewpostid'";
            $rows=mysqli_query($dbc,$q);
            foreach($rows as $r)
              {
                  $tropic=$r['tropic'];
              }
        }
              
      else {
               
        $_SESSION['success']="No Comments "."Comments Id:  ".$viewpostid ;	
        header('Location: ViewUsers.php');
              
      }}
//Retreive comments related to the selected post
?> 
  

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Manage Forum Comments</h1>
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
<div class="col">

<div class="card shadow mb-4">
<div class="card-header py-3">
  <h3 class="m-0 font-weight-bold text-primary">Tropic: <?php echo $tropic ?></h3>
 
</div>
<div class="card-body">
<h5 class="m-0 font-weight-bold ">Subject: <?php echo $r['subject'] ?></h5>
<h6 class="m-0 font-weight-bold ">Message:</h6>
        <?php echo $r['message'] ?>    </div>
</div>

</div>



             




            <div class="card shadow mb-4">

            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Post Commets</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                     <th> Name</th>
                      <th>Message</th>
                      <th>Registered Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                         <th>ID</th>
                        <th> Name</th>
                         <th>Message</th>
                          <th>Registered Date</th>
                          <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 

        //Post selection from perticular user comments
         $qq="SELECT * 
         FROM posts
         INNER JOIN users
         on posts.user_id=users.user_id";
          $r=@mysqli_query($dbc,$qq);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         //Post selection from perticular user comments
          ?>
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
        <td><?php echo $row['post_id'] ?></td>
          <td><?php echo $row['first_name'].' '.$row['last_name']  ?></td>
          <td><?php echo $row['message'] ?></td>
          <td><?php echo $row['posted_on'] ?></td>
          
          <td>  <div class="btn-group" role="group" aria-label="First group">
 
  <form action="Register.php" method="post">  
  
  <input type="hidden" name="removecommentid" value="<?php echo $row['post_id'];?>">
<button class="btn btn-danger" name="delcommentbtn" data-href="Register.php?remove=<?php echo $row['user_id'] ?>" onclick="return confirm('Are You Sure to Delete this <?php echo $row['post_id'] ?> ?')">
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
  <?php include('../includes/footer.php');?>  