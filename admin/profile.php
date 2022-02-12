<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                        <?php 
  
                        if(isset($_SESSION['username'])) {
                          $username = $_SESSION['username'];

                          $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
                          $select_user_profile_query = mysqli_query($connection, $query);
                          if(!$select_user_profile_query) {
                            die("Query FAILED" . mysqli_error($connection));
                          }

                          while($row = mysqli_fetch_array($select_user_profile_query)) {
                            // $user_id = $row['user_id'];
                            $user_username = $row['user_username'];
                            $user_password = $row['user_password'];
                            $user_firstName = $row['user_firstName'];
                            $user_lastName = $row['user_lastName'];
                            $user_email = $row['user_email'];
                            // $user_image = $row['user_image'];
                            $user_role = $row['user_role'];
                          }
                        }
                        
                        ?>

                        <?php 
                        
                        if(isset($_POST['update_user'])) {
                          $user_username = $_POST['user_username'];
                          $user_password = $_POST['user_password'];
                          $user_firstName = $_POST['user_firstName'];
                          $user_lastName = $_POST['user_lastName'];
                          $user_email = $_POST['user_email'];
                          $user_role = $_POST['user_role'];
                          
                          // Sending Updated User Information into the Database
                          $query = "UPDATE users SET user_username = '{$user_username}', user_password = '{$user_password}', user_firstName = '{$user_firstName}', user_lastName = '{$user_lastName}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_username = '{$user_username}' ";
                          
                          $update_profile_query = mysqli_query($connection, $query);
                        
                          confirm_query($update_profile_query);
                        }

                        ?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstName">First Name</label>
    <input class="form-control" type="text" value="<?php echo $user_firstName; ?>" name="user_firstName">
  </div>
  <div class="form-group">
    <label for="user_lastName">Last Name</label>
    <input class="form-control" type="text" value="<?php echo $user_lastName; ?>" name="user_lastName">
  </div>
  <label for="user_role">Role</label>
  <div class="form-group">
    <select name="user_role" id="">

      <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
      
      <!-- Changing the Role of the User on the Edit User Page -->
      <?php 
      
      if($user_role == 'admin') {
        echo "<option value='subscriber'>subscriber</option>";
      } else {
        echo "<option value='admin'>admin</option>";
      }

      ?>

    </select>
  </div>
  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-control" type="file" name="image">
  </div> -->
  <div class="form-group">
    <label for="user_username">Username</label>
    <input class="form-control" type="text" value="<?php echo $user_username; ?>" name="user_username">
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input class="form-control" type="email" value="<?php echo $user_email; ?>" name="user_email">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input class="form-control" type="password" value="<?php echo $user_password; ?>" name="user_password">
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
  </div>
</form>

                    </div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
