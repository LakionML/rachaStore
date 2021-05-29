<?php
session_start();
require	('./mysqli_connect.php');
//Executes using post button
if(isset($_POST['postbtn']))
{
	
    $uid=($_POST['uid']);
    $mesid=($_POST['mesid']);
    $add=date('Y-m-d h:i:s');
    $mes=($_POST['message']);

      $q = "INSERT INTO `posts`(`post_id`, `mes_id`, `user_id`, `message`, `posted_on`) VALUES (null,'$mesid','$uid','$mes','$add')";		
        $r = @mysqli_query ($dbc, $q);
                if ($r)
                  { 
                
                  $_SESSION['success']="Your comment posted ";	
                  header('Location: Forum.php');
               
                  } 
            
                else 
                { 
                    
                  $_SESSION['status']="Your comment not posted";	
                  header('Location: Forum.php');
                } 
              
            mysqli_close($dbc);
 }

          
 //post comment button         
 if(isset($_POST['postmessagebtn'])){

            $uid=($_POST['uid']);
            $topic=($_POST['topic']);
            $subject=($_POST['subject']);
            $message=($_POST['message']);
            $add=date('Y-m-d h:i:s');
          $q = "INSERT INTO `messages`(`user_id`, `tropic`, `subject`, `message`, `date`, `parent_id`) VALUES('$uid','$topic','$subject','$message','$add','1')";		
                $r = @mysqli_query ($dbc, $q);
                        if ($r)
                          { 
                        
                          $_SESSION['successpost']="Your Post posted ";	
                          header('Location: Forum.php');
                       
                          } 
                    
                        else 
                        { 
                            
                          $_SESSION['statuspost']="Your post not posted";	
                          header('Location: Forum.php');
                        } 
                      
                    mysqli_close($dbc);
                  }
             
                  
                  if(isset($_POST['replydelbtn']))
                  {
                  
                       
                        $did=$_POST['duid'];
                        $dmid=$_POST['dmesid'];
                            if($did>0){
               
                     
                          $q=" DELETE FROM `posts` WHERE user_id='$did' and mes_id='$dmid'";
                          $r=mysqli_query($dbc,$q);
                          $_SESSION['dsuccess']="Your comment deleted ";	
                          header('Location: Forum.php');
                          
                          }
                                
                        else {
                                 
                   
                          $_SESSION['dstatus']="Your comment can not deleted".$did ;	
                          header('Location: Forum.php');
                                
                        }
                          
                              
                  
                  
                  }

                  
    




?>