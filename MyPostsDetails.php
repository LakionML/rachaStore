
<?php 
ob_start();
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
if ($uu=='Guest') {

  header('location: login.php'); exit();
}

if(isset($_POST['viewPost']))
{

     
      $viewpostid=$_POST['viewpostmyid'];
      $uids=$_POST['uidss'];
      
          if($viewpostid>0){
        
            $q="SELECT * FROM posts INNER JOIN messages on messages.message_id='$viewpostid' WHERE messages.user_id='$uids'";
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

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 mt-4">My Forum Post Details</h1>
<?php 
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
                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                         <th>ID</th>
                        <th> Name</th>
                         <th>Message</th>
                          <th>Registered Date</th>
                         
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>

                    <?php 

        //Customer post details
         $qq="SELECT * 
         FROM posts
         INNER JOIN users
         on posts.user_id=users.user_id
         WHERE posts.mes_id='$viewpostid'";
          $r=@mysqli_query($dbc,$qq);
          if(@mysqli_num_rows($r)>0)
          
          {
           
         
          ?>
          <?php

while($row=mysqli_fetch_assoc($r))
{
 ?>
        <td><?php echo $row['post_id'] ?></td>
          <td><?php echo $row['first_name'].' '.$row['last_name']  ?></td>
          <td><?php echo $row['message'] ?></td>
          <td><?php echo $row['posted_on'] ?></td>










                    </tr>
                    <?php 
}

?>
  </tbody>
 <?php
         }
         else{

echo "no comments found";

         }
        
            
        ?>


  
</table>     
       
                  </tbody>
                </table>
              </div>
            </div>  </div>  </div>  </div>  </div>   <?php include('./includes/footer-front.php');?>  