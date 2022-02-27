<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>
<tbody>

<!-- Collect and Display All Users in a Table -->
<?php 

$query = "SELECT * FROM users" ;
$select_users = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_users)) {
  $user_id = $row['user_id'];
  $user_username = $row['user_username'];
  $user_password = $row['user_password'];
  $user_firstName = $row['user_firstName'];
  $user_lastName = $row['user_lastName'];
  $user_email = $row['user_email'];
  $user_image = $row['user_image'];
  $user_role = $row['user_role'];


echo "<tr>";
  echo "<td>$user_id</td>";
  echo "<td>$user_username</td>";
  echo "<td>$user_firstName</td>";
  echo "<td>$user_lastName</td>";
  
  // Creating a Link to take you to the Post where the Comment was made
  // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
  // $select_post_id_query = mysqli_query($connection,$query);

  // while($row = mysqli_fetch_assoc($select_post_id_query)) {
  //   $post_id = $row['post_id'];
  //   $post_title = $row['post_title'];

  //   echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
  // }

  echo "<td>$user_email</td>";
  echo "<td>$user_role</td>";
  echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
  echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
  echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
  // Javascript confirmation popup asking user if they are sure they want to delete the item
  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='users.php?delete={$user_id}'>Delete</a></td>";
echo "</tr>";
}

?>

<?php 

// Change the Role of the User to Admin
if(isset($_GET['change_to_admin'])) {
  $user_id = escape($_GET['change_to_admin']);
  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id ";
  $change_admin_query = mysqli_query($connection, $query);
  header("Location: users.php");
}

// Change the Role of the User to Subscriber
if(isset($_GET['change_to_subscriber'])) {
  $user_id = escape($_GET['change_to_subscriber']);
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id ";
  $change_subscriber_query = mysqli_query($connection, $query);
  header("Location: users.php");
}

// Deleting Users from the View All Users Table
if(isset($_GET['delete'])) {
  if(isset($_SESSION['user_role'])) {
    if($_SESSION['user_role'] == 'admin') {
  $delete_user_id = escape($_GET['delete']);
  $query = "DELETE FROM users WHERE user_id = $delete_user_id";
  $delete_query = mysqli_query($connection, $query);
  header("Location: users.php");
    }
  }
}

?>


</tbody>
</table>