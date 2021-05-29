<?php
require('./mysqli_connect.php');	
session_start();
$uu=$_SESSION['username'];
$IP=$_SESSION['IP_ADDRESS'];
//Add to cart process
if (isset($_POST['pid'])) 
{
     $pid=$_POST['pid'];
     $qty=$_POST['qty'];
     $pname=$_POST['pname'];
     $pprice=$_POST['pprice'];
     $pimg=$_POST['pimg'];
     $IP=$_POST['IP'];
     $pqty=1;

     $quser="SELECT user_id  FROM users where email='$uu'";
     $quserrun=mysqli_query($dbc,$quser);
     $uidfetch=mysqli_fetch_assoc($quserrun);
     $uid=$uidfetch['user_id']; 

     $q="SELECT product_id FROM cart where product_id=$pid and uid='$uid' and IP='$IP'";
     $qrun=mysqli_query($dbc,$q);
     $rows=mysqli_fetch_assoc($qrun);

    $code=$rows['product_id'];  
    //print_r($code);      
    
     if (!$code) {
       
        $qr="INSERT INTO `cart`(`id`,`product_name`, `product_price`, `product_image`, `product_id`, `qty`, `Total`,`uid`,`IP`)
        VALUES (NULL,'$pname','$pprice','$pimg','$pid','$pqty','$pprice','$uid','$IP')";
        //$qr="INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `product_id`, `qty`, `Total`) VALUES (NULL, '1', '2', '3', '4', '5', '6')";

      $rr = @mysqli_query ($dbc, $qr);
      
      echo'<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Item added to your cart !</strong> <a href="AddCart.php" class="btn btn-outline-success text-right" role="button" aria-disabled="true">Click Here to Check Your Cart</a>     </div>';
     
    }
    else {
        echo'<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Item already added to your cart !   </strong><a href="AddCart.php" class="btn btn-outline-success text-right" role="button" aria-disabled="true">Click Here to Check Your Cart</a>    </div>';
    }
 
}
//Take user cart information
if (isset($_GET['cartItem'])&&isset($_GET['cartItem'])=='cart_item') 
{
  //  require	('./mysqli_connect.php');	 
  $quser="SELECT user_id  FROM users where email='$uu'";
  $quserrun=mysqli_query($dbc,$quser);
  $uidfetch=mysqli_fetch_assoc($quserrun);
  $uid=$uidfetch['user_id']; 
    $q="SELECT * FROM `cart` where uid='$uid' And IP='$IP'";
    $r=mysqli_query($dbc,$q);
    $row=mysqli_num_rows($r);
    echo $row;
    
}
//Delete Cart
if (isset($_GET['remove']))
 {
      $id=$_GET['remove'];
      if (!empty($id)) 
        {
          if($id>0)
          
          {
if ($uid=='0') {
  $q=" DELETE FROM `cart` WHERE id='$id' AND uid='0' and IP='$IP'";
      
  $r=mysqli_query($dbc,$q);
      
  $_SESSION['showAlert']='block' ;	
    $_SESSION['message']='Item Removed from your cart' ;	
  header('Location: AddCart.php');
}
else {

  $quser="SELECT user_id  FROM users where email='$uu'";
  $quserrun=mysqli_query($dbc,$quser);
  $uidfetch=mysqli_fetch_assoc($quserrun);
  $uid=$uidfetch['user_id'];
  $q=" DELETE FROM `cart` WHERE id='$id' AND uid='$uid'";
      
  $r=mysqli_query($dbc,$q);
      
  $_SESSION['showAlert']='block' ;	
    $_SESSION['message']='Item Removed from your cart' ;	
  header('Location: AddCart.php');
}

        $q=" DELETE FROM `cart` WHERE id='$id' AND uid='$uid' and IP='$IP'";
      
        $r=mysqli_query($dbc,$q);
            
        $_SESSION['showAlert']='block' ;	
          $_SESSION['message']='Item Removed from your cart' ;	
        header('Location: AddCart.php');
        }
              
      else {

        $quser="SELECT user_id  FROM users where email='$uu'";
        $quserrun=mysqli_query($dbc,$quser);
        $uidfetch=mysqli_fetch_assoc($quserrun);
        $uid=$uidfetch['user_id']; 
                $q=" DELETE FROM `cart` where uid='$uid' And IP='$IP'";
      
                $r=mysqli_query($dbc,$q);
                  
                        $_SESSION['showAlert']='block' ;	
                        $_SESSION['message']='All Item Removed from your cart' ;	
                        unset($_SESSION['shopping_cart']);
                        header('Location: AddCart.php');
              
      }
        
        }      


}
//Cart Item number change
if (isset($_POST['qty'])) 
{
  $quser="SELECT user_id  FROM users where email='$uu'";
  $quserrun=mysqli_query($dbc,$quser);
  $uidfetch=mysqli_fetch_assoc($quserrun);
  $uid=$uidfetch['user_id']; 
  $qty=$_POST['qty'];
  $piid=$_POST['piid']??0;
  $pprice=$_POST['pprice'];
  $total=$qty*$pprice;
  $q = "UPDATE cart SET qty='$qty',Total='$total' WHERE id='$piid' and uid='$uid' and IP='$IP' ";	
  $r=mysqli_query($dbc,$q);
   
 
   
}
//Pay now button triggers
if (isset($_POST['paynowbtn'])) 
{
  $cuid=$_POST['cuid'];
  $tot=$_POST['total'];
  $add=date('Y-m-d h:i:s');
$paymethod=$_POST['paymethod'];
if ($paymethod=="Cash On Delivery") {
$orderstat='2';

}else {
  $orderstat='1';
  
}

  $qr= "INSERT INTO `orders` (`id`, `user_id`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) 
  VALUES (NULL, '$cuid', '$paymethod', '$tot', 'Success', '$orderstat','$add')";
  //$qr="INSERT INTO `order`(`user_id`, `payment_type`, `total_price`, `payment_status`, `$orderstat`, `added_on`) VALUES ('$cuid','Credit Card','$tot','Success','1',NOW()";
           
     $rr = @mysqli_query ($dbc, $qr);
              if ($rr)
                    { 
                      $order_id=mysqli_insert_id($dbc);    

                      $totq="SELECT * FROM `cart` where uid='$cuid'";
                      $r=@mysqli_query($dbc,$totq);
                     // while($row=mysqli_fetch_assoc($r))
                      while($row =mysqli_fetch_array($r)) 
                      {
                      $pcid=$row['product_id'];
                      $total=$row['Total'];
                      $itemname=$row['product_name'];
                      $items=$row['qty'];
                      $cost=$row['product_price'];
                     
                 
                      
                      $qdetail= "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) 
                      VALUES (NULL, '$order_id', '$pcid', '$items', '$cost')";
                      $rra = @mysqli_query ($dbc, $qdetail); 
                      $qd=" DELETE FROM `cart` where uid=$cuid";
                      $rd=mysqli_query($dbc,$qd);
                      $_SESSION['sucssess']="Payment Successful";	
                      header('Location: PaymentSucces.php');
                      
                    }
                   
                   
            
            
                    
                    }

           
  }
   
 
  







//Deletes post from the front end
  if(isset($_POST['DelPost']))
  {
  
       
        $id=$_POST['removemypostid'];
        $uids=$_POST['removemyuid'];
            if($id>0){
      
     
          $q=" DELETE FROM `messages` WHERE message_id='$id' and user_id='$uids'";
          $r=mysqli_query($dbc,$q);
          $_SESSION['success']="Post successfully Deleted "."Post Id:  ".$id ;	
          header('Location: YourPosts.php');
          
          }
                
        else {
                 
          $_SESSION['status']="Post cannot be Deleted "."Post Id:  ".$id ;	
          header('Location: YourPosts.php');
                
        }
  
  }
  //Checkout button
  if(isset($_POST['GuestBTN']))
  {
if ($uu=='Guest') 
{
$id=$_POST['GIP'];
 echo $id."Guest";
 header('Location: login.php');
}
else
{
  $id=$_POST['GIP'];
  header('Location: Checkout.php');

}
       
        
      
  
  }
  
  
  
  
  
  
  ?>