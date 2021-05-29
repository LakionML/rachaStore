<?php 
$page_title = 'Contact Us';
session_start();

include('./includes/header_Front.php');
$page_title = 'Contact Us';

?>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3076.6028659229387!2d176.83955541522968!3d-39.546012079475794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d69b46ab6fb3975%3A0x5906e7e60c161174!2sEIT%20Student%20Village!5e0!3m2!1sen!2snz!4v1589771271523!5m2!1sen!2snz" width="100%" height="300px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
<div class="row" style="margin-bottom: 60px; margin-top: 50px">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Get In Touch</h2>
          </div>
          <div class="col-md-7">

          <form action="" method="post">
              
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_subject" class="text-black">Subject </label>
                    <input type="text" class="form-control" id="c_subject" name="c_subject">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Message </label>
                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="subbtn" value="Send Message">
                  </div>
                </div>
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
              </div>
            </form>
          </div>
          <div class="col-md-5 ml-auto">
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">New Zealand</span>
              <p class="mb-0">Gloucestor Street, Taradale, Napier, Hawkes Bay, New Zealand</p>
            </div>
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">London</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">Canada</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>

          </div>
        </div>
        </div></div>
  <!-- /.container -->

  <?php
  //Sending customer enquiry to email
if(isset($_POST['subbtn'])){
$fn= $_POST['c_fname'];
$ln= $_POST['c_lname'];
$email= $_POST['c_email'];
$subjects= $_POST['c_subject'];
$message= $_POST['c_message'];
/*
$to = "20laklria@gmail.com";
$subject = "Racha website".$subject;
$txt = "Name".$fn.' '.$ln.' Messge'."$message";
$headers = "From:". $email . "\r\n" .
"CC: raghu86babu@gmail.com ";*/
    //Contact us  email
    $To='20laklira@gmail.com,raghu86babu@gmail.com ';// charith and raghu emails
    $subject="Racha website".$subjects;
    $messge= "Name".$fn.' '.$ln.' Messge'.$message. ' Email:'.$email;
    $header="From:racha @gmail.com\r\n " .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=utf-8';
    $sent= mail($To,$subject,$messge,$header);



if($sent){
	$_SESSION['success']= "Your email has been sent.";
}else{
 
  $_SESSION['status']= "There was a problem sending your email.";
}
}


?>
<?php include('./includes/footer-front.php');?>  