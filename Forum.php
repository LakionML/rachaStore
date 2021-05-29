<?php 
session_start();
$page_title = 'Forum';
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
?>

<div class="container-fluid">

<div class="jumbotron">
  <h1 class="display-4 text-center">Forum</h1>
  <p class="lead">Latest</p>
  <a class="btn btn-primary" href="YourPosts.php">
   <i class="fas fa-file-alt"></i> View Your Posts  </a>
</div>
    
<div class="row">

<div class="col">

 
<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Create a post</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
             
  <div class="form-row">
    <div class="form-group col-md-6">
    <form	action="Forumfun.php" method="post">       
                                    
      <input type="text" name="topic" class="form-control" placeholder="Topic">
    </div>
    <div class="form-group col-md-6">

      <input type="text" class="form-control" name="subject" placeholder="Subject">
    </div>
  </div>
  <div class="form-group">
   
  <textarea class="form-control" name="message" rows="3" placeholder="Enter Your Message?"></textarea>
  </div>

                 
                  </div>
                  <hr>
                  <input type="hidden" name="uid" value=<?php echo $uid?> ></input>
                  <div class="text-right">
                  <button type="submit" name="postmessagebtn" class="btn btn-primary " style="width: 100px">Post</button>
</form>
                              <?php 
                              //Shows the error and successfull messages
                                if(isset($_SESSION['successpost']) && $_SESSION['successpost']!='')
                                {
                                echo'<div class="alert alert-success text-center" role="alert">'.$_SESSION['successpost'].'</div>';
                                unset($_SESSION['successpost']);


                                }
                                if(isset($_SESSION['statuspost']) && $_SESSION['statuspost']!=''){
                                  echo'<div class="alert alert-danger" role="alert">'.$_SESSION['statuspost'].'</div>';
                                  unset($_SESSION['statuspost']);     
                                }


                               ?>
                
                
                </div></div>
              </div>

  <!-- POST AREA -->
  <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Latest Tropics</h6>
            
          </div>
          <?php 
                                                      if(isset($_SESSION['dsuccess']) && $_SESSION['dsuccess']!='')
                                                      {
                                                      echo'<div class="alert alert-success text-center" role="alert">'.$_SESSION['dsuccess'].'</div>';
                                                      unset($_SESSION['dsuccess']);


                                                      }
                                                      if(isset($_SESSION['dstatus']) && $_SESSION['status']!=''){
                                                        echo'<div class="alert alert-danger" role="alert">'.$_SESSION['dstatus'].'</div>';
                                                        unset($_SESSION['dstatus']);     
                                                      }


                                                      ?>
    <div class="card-body">

                    <?php


                $user="SELECT * FROM users INNER JOIN messages ON messages.user_id=users.user_id ORDER BY messages.date DESC";
                $prun=mysqli_query($dbc,$user);

                if (mysqli_num_rows($prun) > 0) {
                while ($rows=mysqli_fetch_assoc($prun)) 
                {?>
                      <div class="card gedf-card mb-3">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mr-2">
                                                    <img class="rounded-circle" width="50" height="50" src="../uploads/<?php echo $rows['images']?>" alt="">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="h5 m-0"><?php echo $rows['first_name']?></div>
                                                    <div class="h7 text-muted"><?php echo $rows['email']?></div>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php echo $rows['date']?></div>
                                        <a class="card-link" href="#">
                                            <h5 class="card-title"><?php echo $rows['tropic']?></h5>
                                        </a>

                                        <p class="card-text">
                                        <?php echo $rows['message']?>
                                        </p>
                                  
                                    </div>
                                    
                                    <div class="card-footer">
                                        
                                      
                                        <a class="card-link" data-toggle="collapse" href="#collapseExample<?php echo $rows['message_id']?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <?php 
                                        $aa=$rows['message_id'];
                                        $uda="SELECT * FROM `posts` WHERE `mes_id`=$aa";
                                        $replycount=mysqli_query($dbc,$uda);
                                        $rowcounts=mysqli_num_rows($replycount);
                                      
                                        echo $rowcounts;?>
                                        <i class="fa fa-comment"></i>  Comments  </a>
                                      
                                        <a href="#" class="card-link" data-toggle="collapse" data-target="#replyview<?php echo $rows['message_id']?>" aria-expanded="false" aria-controls="collapseExample"> Leave a Reply</a>
                                      

                                                                            
                                                                          
                                                                                    
                                                                                          <?php 
                                                      if(isset($_SESSION['success']) && $_SESSION['success']!='')
                                                      {
                                                      echo'<div class="alert alert-success text-center" role="alert">'.$_SESSION['success'].'</div>';
                                                      unset($_SESSION['success']);


                                                      }
                                                      if(isset($_SESSION['status']) && $_SESSION['status']!=''){
                                                        echo'<div class="alert alert-danger" role="alert">'.$_SESSION['status'].'</div>';
                                                        unset($_SESSION['status']);     
                                                      }


                                                      ?>
                                      
                                <div class="collapse" id="collapseExample<?php echo $rows['message_id']?>">
                                  
                                                <?php
                                                //Retrive post comments
                                                $mids=$rows['message_id'];
                                                
                                              $usersposts="SELECT posts.message as message,users.first_name as firstname,users.last_name as lastname,posts.posted_on as dated,users.user_id as user_id
                                              FROM posts
                                              INNER JOIN users ON posts.user_id=users.user_id WHERE  posts.mes_id='$mids'";
                                            $prunposts=mysqli_query($dbc,$usersposts);

                                            if (mysqli_num_rows($prunposts) > 0) {
                                            while ($rowspost=mysqli_fetch_assoc($prunposts)) 
                                            {?>

                                          <div class="card">
                                            <div class="card-body ">
                                              <blockquote class="blockquote mb-0">
                                                <p><?php echo $rowspost['message']?></p>
                                                <footer class="blockquote-footer"><?php echo $rowspost['firstname'].' '.$rowspost['lastname'].' Posted On '?><cite title="Source Title"><?php echo $rowspost['dated']?></cite></footer>
                                              </blockquote>
                                                           
                                         
<?php $ruid=$rowspost['user_id'];



if ($uids==$ruid) {
  echo '   
  
  <form	action="Forumfun.php" method="post">       
  <input type="hidden" name="duid" value="'.$uids.'"</input>
  <input type="hidden" name="dmesid" value="'.$mids.'"</input>
                                              
  
  <button type="submit" name="replydelbtn" class="btn btn-danger"> <i class="fa fa-trash"></i>  Delete  </button></form>
  ';
 
}
else
{



}
?>

                                               </div>
                                          </div> 
                                

                                          <?php }}

                                          else {
                                            echo'
                                            <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                              <p>No Comments Yet</p>
                                              
                                            </blockquote>
                                          </div>
                                       
                                          ';}
                                          ?>

                                </div>


                                


                    <div class="collapse" id="replyview<?php echo $rows['message_id']?>">
                              <div class="card card-body">

                              <div class="form-group">
                                                        <form	action="Forumfun.php" method="post">        <label class="sr-only" for="message">post</label>
                                                                <textarea class="form-control" name="message" rows="3" placeholder="What are you thinking?"></textarea>
                                                            </div>

                                                            <input type="hidden" name="uid" value=<?php echo $uids?> ></input>
                                                            <input type="hidden" name="mesid" value=<?php echo $rows['message_id']?>></input>
                                                              <button type="submit" name="postbtn" class="btn btn-primary">share</button></form> </div>  
                    </div>

                    </div>
                      </div>            

                  <?php } }
                                
                                else{

                                  echo '<div class="row justify-content-center">
                                  <div class="col"><div class="alert alert-warning" role="alert">
                                  There are no Forum Post, it will be added soon.
                                  </div></div></div>';
                                  
                                          }
                                
                                ?>     



                                
                                
                                
                            
                    
                    
                              





     </div>
         <!-- POST body close AREA -->     
            </div>
    
    </div>
  </div>

</div>




