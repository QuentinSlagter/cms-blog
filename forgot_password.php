<?php  include "includes/header.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "admin/functions.php"; ?>

<?php 

if(isset($_POST['recover-submit'])) {
  $email = escape($_POST['email']);

  $error = [
      'email' == '',
  ];

  if(empty($email)) {
    $error['email'] = "<p class='bg-danger'>Email cannot be empty</p>";
  }

  if(!email_exists($email) && !empty($email)) {
    $error['email'] = "<p class ='bg-warning'>This email does not belong to anyone in this database. Please double check the spelling of your email or try another email.<?p>";
  }

  elseif (email_exists($email)) {

    // Give the user a success or failure message
    $message = "<h4 class='bg-success text-center'>Form Submitted! Please check your email for a link to change your password.</h4>";
  } 
}

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                    <h6 class="text-center"><?php echo $message; ?></h6>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                                              </div>
                                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

