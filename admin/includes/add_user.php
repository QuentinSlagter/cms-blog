<?php 

// Posting Data from the Form to the Database
if(isset($_POST['create_user'])) {
  $user_firstName = escape($_POST['user_firstName']);
  $user_lastName = escape($_POST['user_lastName']);
  $user_role = escape($_POST['user_role']);

  // $post_image = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];
  
  $user_username = escape($_POST['user_username']);
  $user_email = escape($_POST['user_email']);
  $user_password= escape($_POST['user_password']);
  // $post_date = date('d-m-y');

  // move_uploaded_file($post_image_temp, "../images/$post_image");

  // Encrypting passwords in the database that are added in the add user page and showing the password before being encrypted in the password field on that add user page
  $query = "SELECT randSalt FROM users";
  $select_randsalt_query = mysqli_query($connection,$query);
  if(!$select_randsalt_query) {
    die("Query Failed" . mysqli_error($connection));
  }

  $row = mysqli_fetch_array($select_randsalt_query);
  $salt = $row['randSalt'];
  $hashed_password = crypt($user_password, $salt);

  $query = "INSERT INTO users(user_firstName,user_lastName,user_role,user_username,user_email,user_password) VALUES('{$user_firstName}','{$user_lastName}','{$user_role}','{$user_username}','{$user_email}','{$hashed_password}' ) ";

  $create_user_query = mysqli_query($connection, $query);

  confirm_query($create_user_query);

  echo "<p class='bg-success'>User Created: " . " " . "<a href='users.php'>View Users</a></p>";
}

?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstName">First Name</label>
    <input class="form-control" type="text" name="user_firstName">
  </div>
  <div class="form-group">
    <label for="user_lastName">Last Name</label>
    <input class="form-control" type="text" name="user_lastName">
  </div>
  <label for="user_role">Role</label>
  <div class="form-group">
    <select name="user_role" id="">
      <option value="subscriber">Select Options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-control" type="file" name="image">
  </div> -->
  <div class="form-group">
    <label for="user_username">Username</label>
    <input class="form-control" type="text" name="user_username">
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input class="form-control" type="email" name="user_email">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input class="form-control" type="password" name="user_password">
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>
</form>