<?php  include "includes/header.php"; ?>
<?php  include "includes/db.php"; ?>

<?php

if(isset($_POST['submit'])) {
    $to = "slagter.quentin@gmail.com";
    $header = "From: " .escape($_POST['email']);
    $subject = wordwrap(escape($_POST['subject']),70);
    $messageContent = wordwrap(escape($_POST['messageContent']),70);

    // Alerting user that fields cannot be blank
    if(!empty($header) && !empty($subject) && !empty($messageContent)) {

      // send email
      mail($to,$subject,$messageContent, $header);

    // Give the user a success or failure message
    $message = "<p class='bg-success'>Form Submitted! If you have any addition concerns or questions, do not hesitate to ask.</p>";
    } else {
        $message = "<p class='bg-danger'>Fields cannot be empty</p>";
    }
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
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter the Subject Title">
                        </div>
                         <div class="form-group">
                            <label for="messageContent">Concerns, or Questions</label>
                            <br>
                            <textarea class="form-control" name="messageContent" id="messageContent" cols="30" rows="10"></textarea>
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
