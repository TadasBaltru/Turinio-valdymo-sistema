<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


 <?php

    if(isset($_POST['submit'])){

        $email = $_POST['email'];
       $subject = $_POST['subject'];
       $content = $_POST['body'];

            $email = mysqli_real_escape_string($connection,$email);
       $subject = mysqli_real_escape_string($connection,$subject);
       $content = mysqli_real_escape_string($connection,$content);


       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
       
       // More headers
       $headers .= 'From: <'.$email.'>' . "\r\n";
       

$to = "tadasbaltru@gmail.com";

      $subject = wordwrap($subject, 70);
      


// use wordwrap() if lines are longer than 70 characters


// send email
mail($to,$subject,$content,$headers);
    }


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact us</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                            
                        </div>
                        <div class="form-group">
                        <label for="body" class="sr-only">Subject</label>
                        
                        <textarea name="body" id="body" class="form-control" placeholder="Content" cols="50" rows="10"></textarea>
                        </div>
                       
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
