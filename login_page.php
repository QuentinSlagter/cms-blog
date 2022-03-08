<?php ob_start(); ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "admin/functions.php"; ?>


<?php 

if(isset($_POST['login'])) {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);

    $error = [
        'username' == '',
        'password' == ''
    ];

    if(empty($username)) {
        $error['username'] = "<p class='bg-danger'>Username cannot be empty</p>";
    }

    if(empty($password)) {
        $error['password'] = "<p class='bg-danger'>Password cannot be empty</p>";
    }

    // Checking if the User is in the Database
    $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_user_query)) {
        $db_id = $row['user_id'];
        $db_user_username = $row['user_username'];
        $db_user_password = $row['user_password'];
        $db_user_firstName = $row['user_firstName'];
        $db_user_lastName = $row['user_lastName'];
        $db_user_role = $row['user_role'];
    }
    
    // Reversing the crypt function to recognize the initial password before being encrypted. It compares the orginial password and the encrypted password.
    $password = crypt($password, $db_user_password);
    
    // Checking if Username and Password are correct to Login into Admin, otherwise it keeps the person on the Index page
    if($username === $db_user_username && $password === $db_user_password) {
        $_SESSION['username'] = $db_user_username;
        $_SESSION['firstName'] = $db_user_firstName;
        $_SESSION['lastName'] = $db_user_lastName;
        $_SESSION['user_role'] = $db_user_role;
    
        header("Location: ../admin/admin_index.php ");
    
    } 
}

?>

    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
<div class="container">

<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">


                        <h3><i class="fa fa-user fa-4x"></i></h3>
                        <h2 class="text-center">Login</h2>
                        <div class="panel-body">

                            <?php 

                            echo $_SESSION['username'];
                            
                            ?>

                            <form id="login-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                                        <input name="username" type="text" class="form-control" placeholder="Enter Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                    </div>
                                    <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                    </div>
                                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                                </div>

                                <div class="form-group">

                                    <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
                                </div>

                                <div class="form-group">
                                    <a href="forgot_password.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
                                </div>


                            </form>

                        </div><!-- Body-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>



<?php include "includes/footer.php"; ?>