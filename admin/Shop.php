<?php 
include('../Security.php');
//Excutes when user clicks on add category button
if(isset($_POST['newCatbtn']))
{
    require	('./mysqli_connect.php');	
		
       $catName = mysqli_real_escape_string($dbc, trim($_POST['Cat_name']));
       
      
            $q = "INSERT INTO Categories (category_name) VALUES ('$catName')";		
		        $r = @mysqli_query ($dbc, $q);

           if ($r)
            { 
            
            $_SESSION['success']="New Category Added";	
            header('Location: Categories.php');
          
            } 
      
          else 
           { 
            	
            $_SESSION['status']="Category could not be added due to a system error";	
            header('Location: Categories.php');
           } 
        
            mysqli_close($dbc);
 }
   
    
    // Delete category
    if(isset($_POST['DeleteCatBtn']))
    {
      require	('./mysqli_connect.php');	
      $id=$_POST['deletecat_id'];
      $catname=$_POST['delete_name'];
       $q=" DELETE FROM `Categories` WHERE category_id=$id";
       
       $r=mysqli_query($dbc,$q);
           if ($r) {
               $_SESSION['success']="Category $catname successfully Deleted !";	
              header('Location: Categories.php');
              mysqli_close($dbc);
            }
           else 
            {
                $_SESSION['success']="Category Cannot Be Deleted";	
                header('Location: Categories.php');
     
            }
      
    }


    //Update category
    if(isset($_POST['updateCatbtn']))
    {
      require	('./mysqli_connect.php');	
       $id=$_POST['edit_id'];
       $upcat=$_POST['updateCatName'];
      
      // $q = "UPDATE categories SET category_name='$upcat' WHERE category_id='$id'";	
       $q = "UPDATE categories SET category_name='$upcat' WHERE category_id='$id'";	


       $r=mysqli_query($dbc,$q);
           if ($r) {
               $_SESSION['success']="updated Category successfully";	
              header('Location: Categories.php');
              mysqli_close($dbc);
            }
           else 
            {
                $_SESSION['success']="Category data not updated !";	
                header('Location: Categories.php');
     
            }
    
    }




    //New product addition
    if(isset($_POST['newprobtn']))
    {
                require	('./mysqli_connect.php');	
   
                    $pn = mysqli_real_escape_string($dbc, trim($_POST['product_name']));
                      $pdesc = mysqli_real_escape_string($dbc, trim($_POST['product_Desc']));
                      $price = mysqli_real_escape_string($dbc, trim($_POST['product_price']));
                      $keys = mysqli_real_escape_string($dbc, trim($_POST['product_keys']));
                      $pcat = mysqli_real_escape_string($dbc, trim($_POST['pcat']));
                      
                      $image_encoded=$_FILES['product_img']['name'];
    
                          $q = "INSERT INTO products (cat_id, date, product_title, product_img, product_price,product_desc, product_keywords) VALUES ('$pcat',NOW(), '$pn', '$image_encoded','$price','$pdesc','$keys')";		
                          $r = @mysqli_query ($dbc, $q);
              
                        if ($r)
                          { 
                          move_uploaded_file($_FILES["product_img"]["tmp_name"],"../../uploads/Products/".$_FILES['product_img']['name']);
                          $_SESSION['success']="New Product added successfully";	
                          header('Location: Products.php');
                        
                          } 
                    
                        else 
                        { 
                            
                          $_SESSION['status']="New Product Cannot be added";	
                          header('Location: Products.php');
                        } 
                      
                    mysqli_close($dbc);
    }
                             

                  
    //Delete product
     if(isset($_POST['DeleteProBtn']))
     {
       require	('./mysqli_connect.php');	
       $id2=$_POST['product_id'];
       $delname=$_POST['delname'];
        $q=" DELETE FROM `products` WHERE product_id=$id2";
        
        $r=mysqli_query($dbc,$q);
            if ($r) {
                $_SESSION['success']="Product $delname successfully Deleted !";	
               header('Location: Products.php');
               mysqli_close($dbc);
             }
            else 
             {
                 $_SESSION['success']="Products Cannot Be Deleted";	
                 header('Location: Products.php');
      
             }
       
     }
     //Update product image
     if(isset($_POST['updateImgbtn']))
     {
       //  $fileupload = $_POST['user_img'];
       if (($_FILES['product_img']['name'])!=null) {
         require	('./mysqli_connect.php');	
         $id=$_POST['edit_id'];
        
         $image_encoded=$_FILES['product_img']['name'];
         $q="UPDATE products SET product_img='$image_encoded' WHERE product_id='$id' ";
         $r = @mysqli_query ($dbc, $q);
      
              if ($r) { 
                  
                  move_uploaded_file($_FILES["product_img"]["tmp_name"],"../../uploads/Products/".$_FILES['product_img']['name']);
                  $_SESSION['success']="Picture Updated successfully";	
                  header('Location: Products.php');
                
              } else { 
                      
                  $_SESSION['status']="You could not be updated";	
                  header('Location: Products.php');
              } 
              
                  mysqli_close($dbc);
       }
       else
       {
       
         header('Location: Products.php');
     
       }
      
     }


     //Edit product details
     if(isset($_POST['editDetailsBtn']))
     {
       require	('./mysqli_connect.php');	
        $id=$_POST['edit_id'];
        $pname=$_POST['pname'];
        $pdesc=$_POST['pdesc'];
        $pprice=$_POST['pprice'];
        $pkey=$_POST['pkey'];
      	$pcat=$_POST['pcat'];
        $q = "UPDATE products SET `cat_id`='$pcat',`product_title`='$pname',`product_price`='$pprice',`product_desc`='$pdesc',`product_keywords`='$pkey' WHERE product_id='$id'";	
 
 
        $r=mysqli_query($dbc,$q);
            if ($r) {
                $_SESSION['success']="updated $pname Product successfully";	
               header('Location: Products.php');
               mysqli_close($dbc);
             }
            else 
             {
                 $_SESSION['success']="Product data not updated !";	
                 header('Location: Products.php');
      
             }
     
     }

?>   
