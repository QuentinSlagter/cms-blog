<?php 

if(isset($_GET['edit_user'])) {
  $edit_user_id = escape($_GET['edit_user']);

// Selecting Individual Users from the Database
$query = "SELECT * FROM users WHERE user_id = $edit_user_id " ;
$select_users_query = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_users_query)) {
  $user_id = $row['user_id'];
  $user_username = $row['user_username'];
  $user_password = $row['user_password'];
  $user_firstName = $row['user_firstName'];
  $user_lastName = $row['user_lastName'];
  $user_email = $row['user_email'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];
  }
}

if(isset($_POST['update_user'])) {
  $user_username = escape($_POST['user_username']);
  $user_password = escape($_POST['user_password']);
  $user_firstName = escape($_POST['user_firstName']);
  $user_lastName = escape($_POST['user_lastName']);
  $user_email = escape($_POST['user_email']);
  $user_role = escape($_POST['user_role']);

  // Encrypting passwords in the database that are changed in the edit user page and showing the password before being encrypted in the password field on that edit user page
  $query = "SELECT randSalt FROM users";
  $select_randsalt_query = mysqli_query($connection,$query);
  if(!$select_randsalt_query) {
    die("Query Failed" . mysqli_error($connection));
  }

  $row = mysqli_fetch_array($select_randsalt_query);
  $salt = $row['randSalt'];
  $hashed_password = crypt($user_password, $salt);
  
  // Sending Updated User Information into the Database
  $query = "UPDATE users SET user_username = '{$user_username}', user_password = '{$hashed_password}', user_firstName = '{$user_firstName}', user_lastName = '{$user_lastName}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = {$edit_user_id} ";
  
  $update_user_query = mysqli_query($connection, $query);

  confirm_query($update_user_query);

  echo "<p class='bg-success'>User Updated: " . " " . "<a href='users.php'>View Users</a></p>";
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
    <input class="btn btn-primary" type="submit" name="update_user" value="Edit User">
  </div>
</form>