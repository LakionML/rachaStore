<?php 
session_start();
$page_title = 'My Posts';
$uu=$_SESSION['username'];
if ($uu=='Guest') {
  $_SESSION['status']="First You Need To Register or Login to View Forum";	
  header('location: login.php'); exit();
}

include('./includes/header_Front.php');

require('./mysqli_connect.php');	

$quser="SELECT user_id  FROM users where email='$uu'";
$quserrun=mysqli_query($dbc,$quser);
$uidfetch=mysqli_fetch_assoc($quserrun);
$uid=$uidfetch['user_id']; 
$uids=$uidfetch['user_id']; 


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
?>


<div class="container-fluid">
<div class="row">  <?php 
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
<p class="mb-4">
    
  

 </div>    </p>

<!-- DataTales Example -->
<div class="card shadow">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">My Posts</h6>
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
	//Showing users posts
$q="SELECT
messages.message_id AS MID,
messages.user_id AS uid,
users.first_name AS first_name,
users.last_name AS last_name,
messages.tropic AS tropic,
messages.subject AS SUBJECT,
messages.message AS message,
messages.date AS DATE
FROM
messages


INNER JOIN users ON users.user_id = messages.user_id

WHERE messages.user_id='$uids'";
$r=@mysqli_query($dbc,$q);
if(@mysqli_num_rows($r)>0)

{
 

?>
<?php

while($row=mysqli_fetch_assoc($r))
{
?>
<td><?php echo $row['MID'] ?></td>
<td><?php echo $row['uid'] ?></td>
<td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
<td><?php echo $row['tropic'] ?></td>
<td><?php echo $row['SUBJECT'] ?></td>
<td><?php echo $row['message'] ?></td>

<td><?php echo $row['DATE'] ?></td>

<td>  <div class="btn-group" role="group" aria-label="First group">
<form action="MyPostsDetails.php" method="post">  

<input type="hidden" name="viewpostmyid" value="<?php echo $row['MID'];?>">
<input type="hidden" name="uidss" value="<?php echo $row['uid'];?>">

<button class="btn btn-success" name="viewPost" type="submit">view</button>

</form>
<form action="action.php" method="post">  

<input type="hidden" name="removemypostid" value="<?php echo $row['MID'];?>">
<input type="hidden" name="removemyuid" value="<?php echo $row['uid'];?>">
<button class="btn btn-danger" name="DelPost" data-href="MyPostsDetails.php?remove=<?php echo $row['MID'] ?>" onclick="return confirm('Are You Sure to Delete this Post <?php echo $row['tropic'] ?> and its comments?')">
Delete
</button>

</form>
</td>









          </tr>
          <?php 
}

?>
</tbody>





<?php
}
else{
  echo '
  <div class="alert alert-warning" role="alert">
  You have no post posted Yet, Lets post something.
  </div>';
  echo "<div class='text-center'><img src='../uploads/Site/nopost.gif'  class='img-fluid'></div>";


}

  
?>   
        </tbody>
      </table>
    
     </div>
  </div>


</div>





</div>



</div>
</div>


<?php include('./includes/footer-front.php');?>  