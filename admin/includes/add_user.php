<?php 

// Posting Data from the Form to the Database
if(isset($_POST['create_user'])) {
  $user_firstName = $_POST['user_firstName'];
  $user_lastName = $_POST['user_lastName'];
  $user_role = $_POST['user_role'];

  // $post_image = $_FILES['image']['name'];
  // $post_image_temp = $_FILES['image']['tmp_name'];
  
  $user_username = $_POST['user_username'];
  $user_email = $_POST['user_email'];
  $user_password= $_POST['user_password'];
  // $post_date = date('d-m-y');

  // move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO users(user_firstName,user_lastName,user_role,user_username,user_email,user_password) VALUES('{$user_firstName}','{$user_lastName}','{$user_role}','{$user_username}','{$user_email}','{$user_password}' ) ";

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